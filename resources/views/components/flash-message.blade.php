{{-- @props(['bgcolor']) --}}
@if(session()->has('message'))
  <script>
    showSnackBar("{{ session('message') }}", "{{ session('status') }}");
  </script>
@endif
