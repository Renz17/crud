document.addEventListener('DOMContentLoaded', function() {
    let deleteLinks = document.querySelectorAll('.delete-record');

    deleteLinks.forEach(function(link) {
      link.addEventListener('click', function(event) {
        event.preventDefault();
        let recordId = this.getAttribute('data-id');
        let deleteUrl = './controllers/delete.php?id=' + recordId;
        document.getElementById('confirmDeleteButton').setAttribute('href', deleteUrl);
        let modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
        modal.show();
      });
    });
  });