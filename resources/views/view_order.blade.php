<html>
    <head>
      <link href="/jquery.loader.min.css" rel="stylesheet" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

      <style type="text/css">
        .sheet {
          float:left;
          width:100px;
          height:150px;
          border:1px dotted #ccc;
          margin:10px;
          font-size: 10px;
          color: #555;
          background-color: #eee;
          cursor: pointer;
          position: relative;
        }
        .sheet p {
          margin: 0;
          position: absolute;
          top: 50%;
          left: 50%;
          margin-right: -50%;
          transform: translate(-50%, -50%);
        }
        .modal {
          width: 100% !important;
        }
        .modal img {
          border: 1px solid black;
          width: 100% !important;
        }
      </style>

      <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
      <script src="/jquery.loader.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>

      <script type="text/javascript">

        $(function() {
          $('body').loader('show');
          $('#printArea').html('&nbsp;');

          $.getJSON(`/orders/print/${$('#id').val()}`, function (data) {
            $.each( data, function( key, val ) {
              $( "<div/>", {
                "class": "sheet",
                "onClick": `viewSheet(${JSON.stringify(val.print_sheet_item)})`,
                "rel": "modal:open",
                html: `<p>Print Sheet ${key+1}<p>`
              }).appendTo( "#printArea" );
            });

            $('body').loader('hide');
          });

        });

        function viewSheet(items) {

          $('body').loader('show');

          $.post("/print", { items }, function(data) {

            $('#modal').html(`<img src="/${data}" />`).modal();
            // $(`<img src="/${data}" />`).appendTo('body').modal();

            $('body').loader('hide');
          }, 'json');

        }
      </script>
    </head>
    <body>
      <input type="hidden" id="id" value="{{ $order->order_id }}" />

      <h1>Order Id: {{ $order->order_id }} - Number: {{ $order->order_number }}</h1>

      <ul>
        @foreach ($order->products as $product)
          <li>{{ $product->title }} - size: {{ $product->size }} => Quant: {{ $product->pivot->quantity }}</li>
        @endforeach
      </ul>

      <div id="printArea" style="width:auto;height:auto;margin-top:15px;">&nbsp;</div>
      <div id="modal" class="modal" style="width:auto;">&nbsp;</div>

    </body>
</html>
