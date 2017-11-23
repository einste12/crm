
        $('#edit-modal').on('show.bs.modal', function(e) {

            var $modal = $(this),
                esseyId = e.relatedTarget.id;

                 $(".modal-body #bookId").val( esseyId );

//            $.ajax({
//                cache: false,
//                type: 'POST',
//                url: 'backend.php',
//                data: 'EID='+essay_id,
//                success: function(data)
//                {

//                }
//            });

});
