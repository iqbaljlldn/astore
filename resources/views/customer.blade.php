<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>name</th>
                <th>email</th>
                <th>phone</th>
                <th>points</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->points }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
