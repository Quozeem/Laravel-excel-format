<!DOCTYPE html>
<html>
<head>
    <title>Mustard Fintech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
   

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>

    <meta name="csrf-token" content="{{csrf_token()}}"/>
    
    

</head>
<body>
     
<div class="container" >
    <div class="card bg-light mt-10">
        <div class="card-header">
            
        </div>
        <div class="card-body">
       
        @if(Session::get('success')) 
            <div class="alert alert-success">
          
               {{Session::get('success')}}
</div>
@endif
            <form action="{{ route('dollarrate') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <input type="file" name="file" required class="form-control"  style = "width:30%;">
                <br>
    
                <button class="btn btn-success">Import Dollar Rate Here</button>
            </form>
            <br>
            <form method="post">
           @csrf 
           <select id="filtered" name="filter">
            <option>Filter Dollar Rate
            <option value="date">By Date</option>   
            <option value="High">By High Rate</option>  
            <option value="Low">By Low Rate</option>   
             
</select>
</form>
  <div style="overflow-x: scroll; width:100%;">
            <table class="table table-bordered mt-3" >
              <thead>  <tr>
                    <th colspan="11">
                    Dollar-Rate For Today
                            </th>
                </tr>
               
               
                      <tr>
                    <th>S/N</th>
                    <th>Dollarrate_rate</th>
                    <th>Dollarrate_date</th>
                   
                    
                </tr>
                <thead>
                <tbody id="fetchfilter">
                @php $i=0; $i +=1; @endphp
            
           @if($dollar_rate != null)   
             @foreach($dollar_rate as $row)
               
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{$row->dollarrate_rate }}</td>
                    <td>{{$row->dollarrate_date }}</td>
                   
                </tr>
</tbody>
                @endforeach
                @endif
            </table>
            
</div><br/><br/>
            {{ $dollar_rate->links() }}

              <canvas id="myChart" height="100px"></canvas>
            <script>
                   $(document).ready(function(){ 
                    $.ajaxSetup({
																			headers:{
			'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
																			}
																		});
                    $('#filtered').on('change', function(){
                        /* filter dollar rate */
                       let filter=$(this).val();
                       console.log(filter)
                 $.ajax({
                                url:"{{route('get_filter_rate')}}",
                                type:'post',
                                data:{
                                    filter:filter
		                       },
                                success:function(response){
                                 console.log(response)
                                  $.each(response,function(key,value){
                                    $('#fetchfilter').append("<tr>"+
                                    "<td>"+value.id+"</td>"+
                                    "<td>"+value.dollarrate_rate+"</td>"+
                                    "<td>"+value.dollarrate_date+"</td>"+
                                  "</tr>");
                                  })
                                 
                                },
                            })
                    
                    });
                   });
                    </script>
                   
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script type="text/javascript">
    //chart js
   var labels =  {{ Js::from($labels) }};

      var users =  {{ Js::from($data) }};
  const data = {

        labels: labels,

        datasets: [{

          label: 'Mustard Flow Chart',

          backgroundColor: 'rgb(255, 99, 132)',

          borderColor: 'rgb(255, 99, 132)',

          data: users,

        }]

      };
   const config = {

        type: 'line',

        data: data,

        options: {}

      };
   const myChart = new Chart(

        document.getElementById('myChart'),

        config

      );

</script>
  <style>
.w-5{
    display:none;
}

</style>
        </div>
    </div>
</div>
     
</body>
</html>