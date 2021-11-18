<html>
   <head>
      <title>Ajax Example</title>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      
   </head>
   
   <body>
       <form class="form-horizontal" role="form" method="POST" action="{{ url('/postJquery') }}" id="frm-insert">
                        {{ csrf_field() }}

                        
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                               
                            </div>
                       

                      
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                
                            </div>
                        

                        

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm mobile</label>

                            <div class="col-md-6">
                                <input id="mobile" type="mobile" class="form-control" name="mobile" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>

    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>
      <script type="text/javascript">
        $(document).ready(function(){
            $.ajaxSetup({
               headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
            });
            $('#frm-insert').on('submit',function(e){
               e.preventDefault();
               var url = $(this).attr('action');
               var post = $(this).attr('method');
               var data = $(this).serialize();
               $.ajax({
                  type:post,
                  url: url,
                  type:data,
                  success:function(data)
                  {
                     console.log(data);
                  }
               })
            })
        });
      </script>
      
      <!--<script>
         function getMessage(){
            $.ajax({
               type:'POST',
               url:'/getmsg',
               data:'_token = <?php //echo "hello" ?>',
               headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
               success:function(data){
                  $("#msg").html(data.msg);
               }
            });
         }
      </script>
      <div id = 'msg'>This message will be replaced using Ajax. 
         Click the button to replace the message.</div>
      <?php
         //echo Form::button('Replace Message',['onClick'=>'getMessage()']);
      ?>-->
   </body>

</html>