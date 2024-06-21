<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
</head>
<style>
body { font-family: DejaVu Sans }
table {
	margin: 0 0 2em 0;
	width: 100%;
}
table tbody tr:nth-child(2n + 1) {
	background-color: #F2F2E6;
}
td {
	border-bottom: #FF9966 solid 1px;
}
td input {
   width: 100%;
}
</style>
<body>

<table id="table" class="table">
   <caption>Optional table caption.</caption>
   <thead id="thead">
      <tr id="0">
         <!-- <th>Nr</th>
         <th>Description</th>
         <th>Description_RUS</th>
         <th>Country</th>
         <th>Qantity</th>
         <th>Price_EUR</th>
         <th>Amount_EUR</th>
         <th>Amount_RUB</th>
         <th><button onclick="deleteAll()">Очистить</button></th> -->
      </tr>
   </thead>
   <tbody id="tbody">
      <!-- <tr id="1">
         <th>1</th>
         <td>Table cell</td>
         <td>Table cell</td>
         <td>Table cell</td>
         <td><input type="text" name="Qantity"/></td>
         <td><input type="text" name="Price_EUR"/></td>
         <td><input type="text" name="Amount_EUR"/></td>
         <td><input type="text" name="Amount_RUB"/></td>
         <td><button onclick="deleteNr()">Удалить</button></td>
      </tr>
      <tr id="2">
         <th>2</th>
         <td>Table cell</td>
         <td>Table cell</td>
         <td>Table cell</td>
         <td><input type="text" name="Qantity"/></td>
         <td><input type="text" name="Price_EUR"/></td>
         <td><input type="text" name="Amount_EUR"/></td>
         <td><input type="text" name="Amount_RUB"/></td>
         <td><button onclick="deleteNr()">Удалить</button></td> -->
   </tbody>
   <tfoot>
      <tr>
         <td colspan="6" style="text-align: right; padding-right: 10px;">Средняя цена:</td>
         <td style="text-align: left; padding-left: 10px;">$758.8</td>
         <td style="text-align: left; padding-left: 10px;">$758.8</td>
         <td></td>
      </tr>
   </tfoot>
</table>
<br>
<hr>
<br>
<table class="table">
   <caption>Добавить товар</caption>
   <thead>
      <tr>
         <th>Nr</th>
         <th>Description</th>
         <th>Description_RUS</th>
         <th>Country</th>
         <th>Qantity</th>
         <th>Price_EUR</th>
         <th>Amount_EUR</th>
         <th>Amount_RUB</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <th id="Nr"></th>
         <td><input type="text" id="Description" name="Description" placeholder="Description"/></td>
         <td><input type="text" id="Description_RUS" name="Description_RUS" placeholder="Description_RUS"/></td>
         <td><input type="text" id="Country" name="Country" placeholder="Country"/></td>
         <td><input type="text" id="Qantity" name="Qantity" placeholder="Qantity"/></td>
         <td><input type="text" id="Price_EUR" name="Price_EUR" placeholder="Price_EUR"/></td>
         <td><input type="text" id="Amount_EUR" name="Amount_EUR" placeholder="Amount_EUR"/></td>
         <td><input type="text" id="Amount_RUB" name="Amount_RUB" placeholder="Amount_RUB"/></td>
      </tr>
   </tbody>
   <tfoot>
      <tr>
         <th colspan="7" style="text-align: right; padding-top: 50px;"></th>
         <th style="text-align: center;"><button onclick="rowCreate()">Добавить</button></th>
      </tr>
   </tfoot>
</table>


<script>
   let data = [
      [
         'Nr',
         'Description',
         'Description_RUS',
         'Country',
         'Qantity',
         'Price_EUR',
         'Amount_EUR',
         'Amount_RUB',
      ]
   ];

   function allAdd(data) {
      let head = document.getElementById('0');
      let tbody = document.getElementById('tbody');

      for (let key in data) {
         if(key != 0) {
            let row = document.createElement('tr');
            row.id = String(key);

            data[key][0] = key;

            data[key].forEach((value) => {
               let col = document.createElement('td');

               col.innerHTML = value;
               row.append(col);
            });
            col = document.createElement('th');
            col.append(buttonAdd(key));
            row.append(col);
            tbody.append(row);
         }
         else {
            data[key].forEach((value) => {
               let col = document.createElement('th');
               col.innerHTML = value;
               head.append(col);
            });
            let col = document.createElement('th');
            col.append(buttonAdd(key));
            head.append(col);
         }
      }
   }

   function newAdd(newRow) {
      let tr = document.createElement('tr');
      tr.id = String(newRow[0]);

      newRow.forEach((value) => {
         let col = document.createElement('td');
         col.innerHTML = value;
         tr.append(col);
      });

      let col = document.createElement('th');
      col.append(buttonAdd(newRow[0]));

      tr.append(col);

      let tbody = document.getElementById('tbody');
      tbody.append(tr);
   }


   function rowCreate() {
      let newRow = [];
      newRow.push(
         document.getElementById('Nr').innerHTML,
         document.getElementById('Description').value,
         document.getElementById('Description_RUS').value,
         document.getElementById('Country').value,
         document.getElementById('Qantity').value,
         document.getElementById('Price_EUR').value,
         document.getElementById('Amount_EUR').value,
         document.getElementById('Amount_RUB').value,
         // 'button'
      );

      data.push(newRow);

      newAdd(newRow);

      let Nr = Number(document.getElementById('Nr').innerHTML);
      document.getElementById('Nr').innerHTML = ++Nr;
      document.getElementById('Description').value = '';
      document.getElementById('Description_RUS').value = '';
      document.getElementById('Country').value = '';
      document.getElementById('Qantity').value = '';
      document.getElementById('Price_EUR').value = '';
      document.getElementById('Amount_EUR').value = '';
      document.getElementById('Amount_RUB').value = '';

   }

   function buttonAdd(id) {
      let btn = document.createElement('button');
      let btnName = 'Удалить';
      let ev = 'deleteNr('+id+')';

      if(id == 0) {
         btnName = 'Очистить';
         ev = 'deleteAll()';
      }

      btn.innerHTML = btnName;
      btn.setAttribute('onclick', ev);
      return btn;
   }

   function deleteNr(id) {
      document.getElementById('0').innerHTML = '';
      document.getElementById('tbody').innerHTML = '';

      data.splice(id, 1)

      document.getElementById('Nr').innerHTML = data.length;

      allAdd(data);
   }

   function deleteAll() {
      document.getElementById('0').innerHTML = '';
      document.getElementById('tbody').innerHTML = '';
      document.getElementById('Nr').innerHTML = 1;
      data.splice(1);
      allAdd(data);
   }

   function add(Nr) {
      allAdd(data)
      document.getElementById('Nr').innerHTML = Nr;
   }

   window.onload = add(1);
</script>
</body>
</html>