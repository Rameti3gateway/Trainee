<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
        table, th, td {
            border: 1px solid black;
        }
        </style>
  </head>
  <body>
  <div class="row" style="text-align: center">
    <h2>Checkin & Checkout Report</h2>
    <h4>ID: {{$profile->id}} &nbsp; &nbsp; Name: {{$profile->name}}</h4>
  </div>

      <table  style="width:100%;text-align: center;">
          <tr>
              <th>
                  Date
              </th>
              <th>
                  Time Checkin
              </th>
              <th>
                  Time Checkout
              </th>
          </tr>
        @foreach($datadata as $data)
          <tr>
            @foreach($data as $value)
                <td>{{$value}}</td>
            @endforeach
          </tr>
        @endforeach
      </table>
  
  </body>
</html>