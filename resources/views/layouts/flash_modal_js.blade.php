@if (session()->has('success'))
    <script>
        $(document).ready(function() {
            // open modal
            $('#success').modal('show');
        })
    </script>
@elseif(session()->has('errors'))
    <script>
        $(document).ready(function() {
            // open modal
            $('#errors').modal('show');
        })
    </script>
@elseif(session()->has('error'))
    <script>
        $(document).ready(function() {
            // open modal
            $('#error').modal('show');
        })
    </script>
@endif
