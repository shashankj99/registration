@section('scripts')

@if (session()->has('success'))
    <script>

        swal("One more stop!", "{!! session()->get('success') !!}", "success");

    </script>
@endif

@if (session()->has('email'))

    <script>

        swal({
            title: "You are not active",
            text: "Want the code again? If Yes, Click Ok",
            type: "error",
        }).then(() => {
            setTimeout(() => {
                $.get('{{ route("code.resend") }}', {email: "{!! session()->get('email') !!}"});
                swal("The Email has been sent");
            }, 2000);
        }).catch(err => {
            if (err) {
                swal("Ooopss!", "Something went wrong!", "error");
            } else {
                swal.stopLoading();
                swal.close();
            }
        });

    </script>

@endif

@endsection