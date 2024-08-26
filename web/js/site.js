$( document ).ready(function() {
    console.log( "ready!" );
    getImage();
});

$( ".submit" ).click(function() {
    const decision = $(this).data('decision');
    const id =  $('#image').data('id');
    $('#image').hide()
    $('#spinner').show()
    getImage();
    sendDecision(id, decision);
});

$('.delete-decision-btn').click(function( event ) {
    const id = $(this).data('id');
    deleteDecision(id);
});

function getImage() {
    $.ajax({
        url: "/site/get-image",
        type: "GET",
        success: function(data) {
            $('#image').attr('src', data.image).data('id', data.id).show()
            $('#spinner').hide()
        },
        error: function() {
            alert('Ошибка получения изображения');
        }
    });
}

function sendDecision(id, decision) {
    $.ajax({
        url: "/site/decision",
        type: "POST",
        data: {
            picsum_id: id,
            decision: decision
        },
        error: function() {
            alert('Ошибка отправки решения');
        }
    });
}

function deleteDecision(id) {
    if (confirm("Отменить решение") === true) {
        $.ajax({
            url: "/admin/delete-decision?id=" + id + "&token=xyz",
            type: "DELETE",
            success: function(data) {
                if (!data.success) {
                    alert('Ошибка удаления решения');
                }
                location.reload();
            },
            error: function() {
                alert('Ошибка удаления решения');
            }
        });
    }
    return false;
}