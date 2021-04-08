<!DOCTYPE html>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
        <style>
            .icon {
                width: 4%;
                cursor: pointer;
            }

            .minus-icon {
                width: 8%;
            }

            a {
                cursor: pointer;
            }
        </style>
    </head>

    <body>
        <table id="users" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Current color</th>
                    <th>Colors</th>
                    <th>Add color</th>
                    <th>Delete color</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <input type="hidden" value="{{ $user->id }}">
                    <td style="background-color: #{{ $user->hex_value }};"></td>
                    <td>
                        <button class="btn"><button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">See/choose colors</button>
                            <div class="dropdown-menu">
                                @foreach ($user->colors as $color)
                                    <input type="hidden" value="{{ $user->id }}">
                                    <a style="background-color: #{{ $color->pivot->hex_value }};" class="dropdown-item">{{ $color->pivot->hex_value }}</a>
                                @endforeach
                            </div>
                        </button>
                    </td>

                    <td>
                        <input type="hidden" value="{{ route('colors.add-user-color', $user->id) }}">
                        <img class="icon plus-icon" src="{{URL::asset('/images/plus-icon.png')}}">
                    </td>

                    <td>
                        <input type="hidden" value="{{ route('colors.delete-user-color', $user->id) }}">
                        <img class="icon minus-icon" src="{{URL::asset('/images/minus-icon.png')}}">
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>

        <script>
            $(document).ready( function () {
                $('#users').DataTable();

                $('.plus-icon').click(function () {
                    window.location = $(this).siblings().val();
                });

                $('.minus-icon').click(function () {
                    window.location = $(this).siblings().val();
                });

                $('a').click(function () {
                    window.location = $(this).siblings().val() + '/change-color/' + $(this).html();
                });
            });
        </script>
    </body>
</html>