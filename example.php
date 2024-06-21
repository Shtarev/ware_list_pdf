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
   <caption>Таблица с внесенными данными</caption>
   <thead id="thead">
      <tr id="0"></tr>
   </thead>
   <tbody id="tbody"></tbody>
   <tfoot>
      <tr>
         <td colspan="6" style="text-align: right; padding-right: 10px;">Цена:</td>
         <td style="text-align: left; padding-left: 10px;">&#x20AC; 758.8 EURO</td>
         <td style="text-align: left; padding-left: 10px;">&#x20bd; 758.8 RUB</td>
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
         <td><input type="number" id="Qantity" name="Qantity" placeholder="Qantity"/></td>
         <td><input type="number" id="Price_EUR" name="Price_EUR" placeholder="Price_EUR"/></td>
         <td><input type="number" id="Amount_EUR" name="Amount_EUR" placeholder="Amount_EUR"/></td>
         <td><input type="number" id="Amount_RUB" name="Amount_RUB" placeholder="Amount_RUB"/></td>
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
   // главный массив
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

   // полностью переписать
   function allAdd(data) {
      let head = document.getElementById('0');
      let tbody = document.getElementById('tbody');

      for (let key in data) {
         if(key != 0) {
            let row = document.createElement('tr');
            row.id = String(key);

            data[key][0] = key;

            data[key].forEach((value, key) => {
               let col = document.createElement('td');
               if(key == 4 || key == 5 || key == 6 || key == 7) {
                  let input = document.createElement('input');
                  input.type = 'number'
                  input.name = data[0][key]
                  input.value = value

                  col.append(input)
                  row.append(col);

               }
               else {
                  if(key != 0) {
                     let textarea = document.createElement('textarea');
                     textarea.type = 'number'
                     textarea.name = data[0][key]
                     textarea.value = value

                     col.append(textarea)
                     row.append(col);

                  }
                  else {
                     let col = document.createElement('th');
                     col.innerHTML = value;
                     row.append(col);
                  }

               }
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

   // добавить новое поле
   function newAdd(newRow) {
      let tr = document.createElement('tr');
      tr.id = String(newRow[0]);


      newRow.forEach((value, key) => {
         if(key != 0) {
            let col = document.createElement('td');
            if(key == 4 || key == 5 || key == 6 || key == 7) {
               let input = document.createElement('input');
               input.type = 'number'
               input.name = data[0][key]
               input.value = value

               col.append(input)
            }
            else {
               let textarea = document.createElement('textarea');
               textarea.name = data[0][key]
               textarea.innerHTML = value

               col.append(textarea)
            }

            tr.append(col);
         }
         else {
            let col = document.createElement('th');
            col.innerHTML = value;
            tr.append(col);
         }
         
      });

      let col = document.createElement('th');
      col.append(buttonAdd(newRow[0]));

      tr.append(col);

      let tbody = document.getElementById('tbody');
      tbody.append(tr);
   }

   // данные для нового поля
   function rowCreate() {
      // получаем данные из формы ввода и заносим их в массив
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
      );

      data.push(newRow); // херачим данные в главный массив

      newAdd(newRow); // передаем данные для нового поля

      // очшщаем форму ввода и увеличиваем в ней Nr
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

   // возвращаем объект кнопки
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

   // удаляем одну запись
   function deleteNr(id) {
      // стираем все таблицы
      document.getElementById('0').innerHTML = '';
      document.getElementById('tbody').innerHTML = '';
      // удаляем запись из главного массива 
      data.splice(id, 1)
      // выставляем правилбный Nr в форме ввода
      document.getElementById('Nr').innerHTML = data.length;
      // отриыовываем все таблицы
      allAdd(data);
   }

   // удаляем все записи кроме основной с нулевым айди
   function deleteAll() {
      document.getElementById('0').innerHTML = '';
      document.getElementById('tbody').innerHTML = '';
      document.getElementById('Nr').innerHTML = 1;
      data.splice(1);
      allAdd(data);
   }

   // первичная отрисовка
   function add(Nr) {
      allAdd(data)
      document.getElementById('Nr').innerHTML = Nr;
   }

   window.onload = add(1);
</script>
</body>
</html>