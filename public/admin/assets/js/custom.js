/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

"use strict";

$(document).ready(function() {
    // Initialize the table
    const table = $('#bukabuka').DataTable({
        ordering: false,
        
    });
  console.log('Table: ', table);
    // Add a search input for each column in the table footer
    table.columns().every(function() {
      const column = this;
      const header = $(column.header()).text().trim();
  
      // Add a search input for this column
      $(column.header()).html('<input type="text" placeholder="Search ' + header + '" />');
  
      // Handle the search input for this column
      $('input', column.header()).on('keyup change', function() {
        if (column.search() !== this.value) {
          column.search(this.value).draw();
        }
      });
    });
  });