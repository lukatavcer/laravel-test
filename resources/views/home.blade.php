<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
            }
            #raw-data {
                display: none;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="text-center my-5">
                <h1>
                    Amazing blockchain app
                </h1>
                <p class="mt-4">
                    <strong>Example:</strong> b6f6991d03df0e2e04dafffcd6bc418aac66049e2cd74b80f14ac86db1e3f0da
                </p>
            </div>
            <div class="row">
                <div class="col-8 offset-2">
                    <form method="get" action="{{ URL::to('/transaction/') }}">
                        <label for="hash">Search transactions by hash id</label>
                        <div class="input-group mb-3">
                            <input
                                type="text"
                                id="hash"
                                name="hash"
                                class="form-control"
                                placeholder="transaction hash.."
                                value="{{ Request::get('hash') }}"
                                required
                            >
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="submit">Search</button>
                            </div>
                        </div>
                        <ul class="list-unstyled">
                        @foreach($errors->all() as $error)
                            <li class="alert alert-danger">
                                {{ $error }}
                            </li>
                        @endforeach
                        </ul>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-10 offset-1 mt-3">
                    @if(isset($transaction))
                        <div class="card">
                            <div class="card-header">
                                <strong>{{ $transaction['hash'] }}</strong>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    Transaction summary
                                    <button class="btn btn-primary btn-sm float-right" onClick="toggleRaw()">Toggle raw data</button>
                                </h5>
                                <p class="card-text">
                                    <table class="table table-sm" id="data">
                                        <tbody>
                                        <tr>
                                            <th scope="row">Size</th>
                                            <td>{{ $transaction['size'] }} (bytes)</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Weight</th>
                                            <td>{{ $transaction['weight'] }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Received Time</th>
                                            <td>{{ date('Y-m-d H:i:s', $transaction['time']) }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Included In Blocks</th>
                                            <td>{{ $transaction['block_height'] }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Blockchain.info url</th>
                                            <td>
                                                <a
                                                    href="https://www.blockchain.com/btc/tx/{{ $transaction['hash'] }}"
                                                    target="_blank"
                                                >
                                                   Click Me
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </p>
                                <pre id="raw-data">
                                    {{ print_r($transaction) }}
                                </pre>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script>
            function toggleRaw() {
                $('#raw-data').toggle();
                $('#data').toggle();
            }
        </script>
    </body>
</html>
