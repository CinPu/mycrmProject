
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Bootply.com - Multiple Modal Overlay</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" type="text/css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="/bootstrap/img/favicon.ico">
    <link rel="apple-touch-icon" href="/bootstrap/img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/bootstrap/img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/bootstrap/img/apple-touch-icon-114x114.png">









    <!-- CSS code from Bootply.com editor -->

    <style type="text/css">


    </style>
</head>

<!-- HTML code from Bootply.com editor -->

<body  >

<h2>Stacked Bootstrap Modal Example.</h1>
    <p>View the source for the implementation.</p>
    <p>There's an article discussing the approach <a href="http://miles-by-motorcycle.com/fv-b-8-670/stacking-bootstrap-dialogs-using-event-callbacks">here</a></p>


    <a data-toggle="modal" href="#myModal" class="btn btn-primary">Launch modal</a>

    <div class="modal" id="myModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Modal 1</h4>
                </div><div class="container"></div>
                <div class="modal-body">
                    Content for the dialog / modal goes here.
                    <br>
                    <br>
                    <br>
                    <p>more content</p>
                    <br>
                    <br>
                    <br>
                    <a data-toggle="modal" href="#myModal2" class="btn btn-primary">Launch modal</a>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                    <a href="#" class="btn btn-primary">Save changes</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="myModal2">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Modal 2</h4>
                </div><div class="container"></div>
                <div class="modal-body">
                    Content for the dialog / modal goes here.
                    <br>
                    <br>
                    <p>come content</p>
                    <br>
                    <br>
                    <br>
                    <a data-toggle="modal" href="#myModal3" class="btn btn-primary">Launch modal</a>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                    <a href="#" class="btn btn-primary">Save changes</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="myModal3">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Modal 3</h4>
                </div><div class="container"></div>
                <div class="modal-body">
                    Content for the dialog / modal goes here.
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <a data-toggle="modal" href="#myModal4" class="btn btn-primary">Launch modal</a>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                    <a href="#" class="btn btn-primary">Save changes</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="myModal4" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Modal 4</h4>
                </div><div class="container"></div>
                <div class="modal-body">
                    Content for the dialog / modal goes here.
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                    <a href="#" class="btn btn-primary">Save changes</a>
                </div>
            </div>
        </div>
    </div>

    <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


    <script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>




    <!-- JavaScript jQuery code from Bootply.com editor -->

    <script type='text/javascript'>

        $(document).ready(function() {

            $('#openBtn').click(function(){
                $('#myModal').modal({show:true})
            });


            $('.modal').on('hidden.bs.modal', function( event ) {
                $(this).removeClass( 'fv-modal-stack' );
                $('body').data( 'fv_open_modals', $('body').data( 'fv_open_modals' ) - 1 );
            });


            $( '.modal' ).on( 'shown.bs.modal', function ( event ) {

                // keep track of the number of open modals

                if ( typeof( $('body').data( 'fv_open_modals' ) ) == 'undefined' )
                {
                    $('body').data( 'fv_open_modals', 0 );
                }


                // if the z-index of this modal has been set, ignore.

                if ( $(this).hasClass( 'fv-modal-stack' ) )
                {
                    return;
                }

                $(this).addClass( 'fv-modal-stack' );

                $('body').data( 'fv_open_modals', $('body').data( 'fv_open_modals' ) + 1 );

                $(this).css('z-index', 1040 + (10 * $('body').data( 'fv_open_modals' )));

                $( '.modal-backdrop' ).not( '.fv-modal-stack' )
                    .css( 'z-index', 1039 + (10 * $('body').data( 'fv_open_modals' )));


                $( '.modal-backdrop' ).not( 'fv-modal-stack' )
                    .addClass( 'fv-modal-stack' );

            });


        });

    </script>

</body>
</html>
