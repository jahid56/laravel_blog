<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Online Blog</title>
    <!-- Core CSS - Include with every page -->
    {!! Html::style('css/bootstrap.min.css') !!} 
    {!! Html::style('css/font-awesome.min.css') !!} 
    {!! Html::style('css/prettyPhoto.css') !!} 
    {!! Html::style('css/animate.min.css') !!} 
    {!! Html::style('css/main.css') !!} 
	  {!! Html::style('css/responsive.css') !!} 

    <!-- Font Awesome -->
    {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css') !!}
    <!-- Ionicons -->
    {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css') !!}
    <!-- DataTables -->
    {!! Html::style('css/datatables/dataTables.bootstrap.css') !!}
    {!! Html::style('css/datatables/rowReorder.dataTables.min.css') !!}
    <!-- Theme style -->
    {!! Html::style('css/AdminLTE.min.css') !!}
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    {!! Html::style('css/skins/_all-skins.min.css') !!}
	
    @yield('style')

  </head>
  <body>
       
       @include('include.header')
       

       @yield('content')
	   
	   @include('include.footer')

  <!-- Core Scripts - Include with every page -->
 {!! Html::script('js/jquery.js') !!}
 {!! Html::script('js/bootstrap.min.js') !!}
 {!! Html::script('js/jquery.prettyPhoto.js') !!}
 {!! Html::script('js/jquery.isotope.min.js') !!}
 {!! Html::script('js/main.js') !!}
 {!! Html::script('js/wow.min.js') !!}

<!-- DataTables -->
{!! Html::script('js/datatables/jquery.dataTables.min.js') !!}
{!! Html::script('js/datatables/dataTables.bootstrap.min.js') !!}
<!-- SlimScroll -->
{!! Html::script('js/slimScroll/jquery.slimscroll.min.js') !!}
<!-- FastClick -->
{!! Html::script('js/fastclick/fastclick.js') !!}
<!-- AdminLTE App -->
{!! Html::script('js/app.min.js') !!}
<!-- page script -->
<script>
$(document).ready(function() {
    var table = $('#example').DataTable( {
        rowReorder: {
            selector: 'tr'
        },
        columnDefs: [
            { targets: 0}
        ]
    } );
} );
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
    
   @yield('script')

   <script type="text/javascript">
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   </script>

  </body>
</html>