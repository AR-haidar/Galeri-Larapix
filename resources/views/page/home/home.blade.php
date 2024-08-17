@extends('layouts.main')

@section('container')
    <div class="container d-flex justify-content-center">
        <div class="mb-2" style="width: 90%" id="read">

        </div>
    </div>

    <script>
        $(document).ready(function() {
            read();
        });

        function slidekomen(id) {
            $('#input-komen' + id).toggle('');
        }

        //read data
        function read() {
            $.get("{{ url('isi') }}", {}, function(data, status) {
                $("#read").html(data);

            });
        }

        //like
        function like(foto_id, user_id) {
            $.ajax({
                type: "get",
                url: "{{ url('like') }}/" + foto_id + "/" + user_id,
                success: function(data) {
                    read();
                }
            });
        }


        //unlike
        function unlike(like_id) {
            $.ajax({
                type: "get",
                url: "{{ url('unlike') }}/" + like_id,
                success: function(data) {
                    read();
                }
            });
        }


        //komen
        function komen(foto_id) {
            var isi_komentar = $("#isi_komentar" + foto_id).val();
            $.ajax({
                type: "get",
                url: "{{ url('komen') }}/" + foto_id,
                data: "isi_komentar=" + isi_komentar,
                success: function(data) {
                    $(".btn-close").click();
                    read();
                }
            });
        }

        function balaskomen(parent) {
            $.ajax({
                type: "get",
                url: "{{ url('unlike') }}/" + like_id,
                success: function(data) {
                    read();
                }
            });
        }

        function deletekomen(foto_id) {
            $.ajax({
                type: "get",
                url: "{{ url('deleteKomen') }}/" + foto_id,
                success: function(data) {
                    $(".btn-close").click();
                    read();
                }
            });
        }
    </script>
@endsection
