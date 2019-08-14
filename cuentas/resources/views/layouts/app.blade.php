<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/flatly/bootstrap.min.css">
    <title>Cuentas Bancarias</title>
</head>
<body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#" style="font-size:30px;">Cuentas Bancarias</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
        </nav>
        <br>

<div class="container">
    @yield('content')
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
<script type="text/javascript">
    
    $(document).on('click','.create-modal',function() {
       $('#create').modal('show');
       $('.form-horizontal').show();
       $('.modal-title').text('Añadir nueva cuenta'); 
    });

    $('#add').click(function(){
       $.ajax({
           type: 'POST',
           url: 'addCuenta',
           data:{
               '_token': $('input[name=_token]').val(),
               'alias': $('input[name=alias]').val(),
               'id_banco': $('select[name=id_banco]').val(),
               'ultimos_digitos': $('input[name=ultimos_digitos]').val()
           },
           success: function(data) {
                if ((data.errors)) {
                    $('.error').removeClass('hidden');
                    $('.error').text(data.errors.alias);
                    $('.error').text(data.errors.id_banco);
                    $('.error').text(data.errors.ultimos_digitos);
                }
                else{
                    $('.error').remove();
                    $('table').append("<tr class='post" + data.id + "'>"+
                                            "<td>" + data.id + "</td>"+
                                            "<td>" + data.alias + "</td>"+
                                            "<td>" + data.id_banco + "</td>"+
                                            "<td>" + data.ultimos_digitos + "</td>"+
                                            "<td><button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-alias='" + data.alias + "' data-banco='" + data.id_banco + "' data-digitos='" + data.ultimos_digitos + "' >Editar</button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-alias='" + data.alias + "' data-banco='" + data.id_banco + "' data-digitos='" + data.ultimos_digitos + "' >Eliminar</button></td>"+
                                        "</tr>");
                    $('#alias').val('');
                    $('#id_banco').val('');
                    $('#ultimos_digitos').val('');
                }   
           }
       })

    });

    $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text(" Update Post");
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Post Edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
       // console.log($(this).data('id'));
       // console.log($(this).data('alias'));
       // console.log($(this).data('banco'));
       // console.log($(this).data('digitos'));

        $('#fid').val($(this).data('id'));
        $('#ali').val($(this).data('alias'));
        $('#id_ban').append();
        $('#digitos').val($(this).data('digitos'));
        $('#myModal').modal('show');
    });



    $(document).on('click', '.edit', function() {
        $.ajax({
            type: 'POST',
            url: 'editCuenta',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'alias': $("#ali").val(),
                'id_banco': $("#id_ban").val(),
                'ultimos_digitos': $("#digitos").val()
            },
            success: function(data) {
                    console.log(data.alias);
                    console.log(data.id);
                    console.log(data.id_banco);
                    console.log(data.ultimos_digitos);
                    $('.post' + data.id).replaceWith(" " +
                        "<tr class='post" + data.id + "'>" +
                        "<td>" + data.id + "</td>" +
                        "<td>" + data.alias + "</td>" +
                        "<td>" + data.id_banco + "</td>" +
                        "<td>" + data.ultimos_digitos + "</td>" +
                        "<td><button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-alias='" + data.alias + "' data-banco='" + data.id_banco + "' data-digitos='" + data.ultimos_digitos + "'></button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-alias='" + data.alias + "' data-banco='" + data.id_banco + "' data-digitos='" + data.ultimos_digitos + "'></button></td>" +
                        "</tr>");
            }
        });
    });

    // form Delete function
    $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text(" Delete");
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete Post');
        $('.id').text($(this).data('id'));
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        $('.title').html($(this).data('title'));
        $('#myModal').modal('show');
    });

    $('.modal-footer>.actionBtn').on('click', '.delete', function(){
        $.ajax({
            type: 'POST',
            url: 'deletePost',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.id').val()
            },
            success: function(data){
                $('.post' + $('.id').text()).remove();
            }
        });
    });


</script>
    
</body>

</html>
