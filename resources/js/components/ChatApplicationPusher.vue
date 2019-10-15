<template>
  <div>
    <beautiful-chat
      :participants="participants"
      :titleImageUrl="titleImageUrl"
      :onMessageWasSent="onMessageWasSent"
      :messageList="messageList"
      :newMessagesCount="newMessagesCount"
      :isOpen="isChatOpen"
      :close="closeChat"
      :icons="icons"
      :open="openChat"
      :showEmoji="true"
      :showFile="true"
      :showTypingIndicator="showTypingIndicator"
      :colors="colors"
      :alwaysScrollToBottom="alwaysScrollToBottom"
      :messageStyling="messageStyling"
      @onType="handleOnType"
      @edit="editMessage"
    >
      <template v-slot:user-avatar="{ message, user }">
        <div
          style="border-radius:50%; color: pink; font-size: 15px; line-height:25px; text-align:center;background: tomato; width: 25px !important; height: 25px !important; min-width: 30px;min-height: 30px;margin: 5px; font-weight:bold"
          v-if="message.type === 'text' && user && user.name"
        >{{user.name.toUpperCase()[0]}}</div>
      </template>
    </beautiful-chat>
  </div>
</template>

<script>
import CloseIcon from "vue-beautiful-chat/src/assets/close-icon.png";
import OpenIcon from "vue-beautiful-chat/src/assets/logo-no-bg.svg";
import FileIcon from "vue-beautiful-chat/src/assets/file.svg";
import CloseIconSvg from "vue-beautiful-chat/src/assets/close.svg";
import { mapGetters } from "vuex";

export default {
  name: "app",
  data() {
    return {
      icons: {
        open: {
          img: OpenIcon,
          name: "default"
        },
        close: {
          img: CloseIcon,
          name: "default"
        },
        file: {
          img: FileIcon,
          name: "default"
        },
        closeSvg: {
          img: CloseIconSvg,
          name: "default"
        }
      },
      participants: [
        {
          id: "3",
          name: "Admin Name",
          imageUrl: "https://avatars3.githubusercontent.com/u/1915989?s=230&v=4"
        }
      ], // the list of all the participant of the conversation. `name` is the user name, `id` is used to establish the author of a message, `imageUrl` is supposed to be the user avatar.
      titleImageUrl:
        "https://a.slack-edge.com/66f9/img/avatars-teams/ava_0001-34.png",
      messageList: [
        { type: "text", author: `me`, data: { text: `Say yes!` } },
        { type: "text", author: `Admin`, data: { text: `No.` } }
      ], // the list of the messages to show, can be paginated and adjusted dynamically
      newMessagesCount: 0,
      isChatOpen: false, // to determine whether the chat window should be open or closed
      showTypingIndicator: "", // when set to a value matching the participant.id it shows the typing indicator for the specific user
      colors: {
        header: {
          bg: "#4e8cff",
          text: "#ffffff"
        },
        launcher: {
          bg: "#4e8cff"
        },
        messageList: {
          bg: "#ffffff"
        },
        sentMessage: {
          bg: "#4e8cff",
          text: "#ffffff"
        },
        receivedMessage: {
          bg: "#eaeaea",
          text: "#222222"
        },
        userInput: {
          bg: "#f4f7f9",
          text: "#565867"
        }
      }, // specifies the color scheme for the component
      alwaysScrollToBottom: false, // when set to true always scrolls the chat to the bottom when new events are in (new message, user starts typing...)

      messageStyling: true, // enables *bold* /emph/ _underline_ and such (more info at github.com/mattezza/msgdown)
      adminId: 3
    };
  },
  async mounted() {
    try {
      await this.onGetCurrentUser();
      this.loadMessage();
    } catch (error) {
      console.log(error);
    }
  },
  computed: {
    ...mapGetters(["currentUser"])
  },
  methods: {
    onGetCurrentUser() {
      return new Promise((reslove, reject) => {
        const retry = () => {
          let count = 0;
          const timeout = setTimeout(() => {
            count++;
            if (count === 5) {
              clearTimeout(timeout);
              reject("cannot get current user");
            }
            if (this.currentUser === null) {
              retry();
            }
            reslove();
          }, 500);
        };
        retry();
      });
    },
    async loadMessage() {
      let app = this;
      try {
        const response = await axios.post("messages", {
          sender_id: app.adminId
        });
        const messages = response.data;
        let formatMessages = messages.map(message => {
          return app.formatMessage(message);
        });
        this.messageList = formatMessages;
      } catch (error) {
        console.log(error);
      }
    },
    async callApiSendMessage(text) {
      try {
        await axios.post("messages/send", {
          sender_id: this.currentUser.id,
          receiver_id: this.adminId,
          message: text
        });
      } catch (error) {
        console.log(error);
      }
    },
    onMessageWasSent(message) {
      this.callApiSendMessage(message.data.text);
      this.newMessagesCount = this.isChatOpen
        ? this.newMessagesCount
        : this.newMessagesCount + 1;
      message.data.meta = this.getCurrentTime();

      // called when the user sends a message
      this.messageList = [...this.messageList, message];
    },
    openChat() {
      // called when the user clicks on the fab button to open the chat
      this.isChatOpen = true;
      this.newMessagesCount = 0;
      let app = this;
      if (app.currentUser.id !== app.adminId) {
        app.chatOpen = true;
        app.chatUserID = app.adminId;

        // Start pusher listener
        Pusher.logToConsole = true;

        var pusher = new Pusher("e9e863659964b9b23e29", {
          cluster: "ap1",
          forceTLS: true
        });

        var channel = pusher.subscribe(
          "newMessage-" + app.adminId + "-" + app.currentUser.id
        ); // newMessage-[chatting-with-who]-[my-id]

        channel.bind("App\\Events\\MessageSent", function(data) {
          app.messageList.push(app.formatMessage(data.message));
        });
        // End pusher listener
        app.loadMessage();
      }
    },
    closeChat() {
      // called when the user clicks on the botton to close the chat
      this.isChatOpen = false;
    },
    handleScrollToTop() {
      // called when the user scrolls message list to top
      // leverage pagination for loading another page of messages
    },
    handleOnType() {
      console.log("Emit typing event");
    },
    editMessage(message) {
      const m = this.messageList.find(m => m.id === message.id);
      m.isEdited = true;
      m.data.text = message.data.text;
    },
    formatMessage(message) {
      let author =
        message.sender_id === this.currentUser.id ? "me" : message.sender.name;
      return {
        type: "text",
        author: author,
        data: {
          text: message.message,
          meta: message.created_at
        }
      };
    },
    getCurrentTime() {
      const date = new Date();
      return `${date.getFullYear()}-${date.getMonth()+1}-${date.getDate()} ${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}`;
    }
  }
};
</script>
