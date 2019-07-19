/**
 *  Document   : table_data.js
 *  Author     : redstar
 *  Description: advance table page script
 *
 **/

$(document).ready(function() {
    'use strict';

    // Automatically add a first row of data
    $('#addRow').click();

    $('#table-rooms').DataTable({
        "scrollX": true,
        "info": false,
        paging: false,
        search: false
            // serverSide: true,
            // ajax: 'http://localhost:8080/api/rooms?api_token=be81524776d1a1cf18f877aca7fb740fdecf9b69a7c5e6f8cc1a125b7b2d3d12'

    });


});