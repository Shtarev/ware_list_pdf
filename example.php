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
<table id="sendData" class="table">
   <caption>Отправитель / Получатель</caption>
   <tbody>
      <tr>
         <th rowspan="4">DATE: </th>
         <td></td>

         <th rowspan="4">SELLER: </th>
         <td><input type="text" id="" name="seller_name" placeholder="Oksana Morozova"/></td>
      </tr>
      <tr>
         <td><input type="text" id="" name="date_date" placeholder="Дата"/></td>
         <td><input type="text" id="" name="seller_street" placeholder="Nordring 66"/></td>
      </tr>
      <tr>
         <td></td>
         <td><input type="text" id="" name="seller_coutry" placeholder="44787 Bochum, Germany"/></td>
      </tr>
   </tbody>

   <tbody>
      <tr>
         <th rowspan="4">FROM: </th>
         <td></td>

         <th rowspan="4">BUYER: </th>
         <td><input type="text" id="" name="buyer_name" placeholder="Andrey Shtarev"/></td>
      </tr>
      <tr>
         <td><input type="text" id="" name="from_data" placeholder="Дата"/></td>
         <td><input type="text" id="" name="buyer_street" placeholder="1-Sovetsky per. 28-34"/></td>
      </tr>
      <tr>
         <td></td>
         <td><input type="text" id="" name="buyer_coutry" placeholder="141100 Shelkovo, Russia"/></td>
      </tr>
   </tbody>
</table>
<br><br>

<table id="table" class="table">
   <caption>Таблица с внесенными данными</caption>
   <thead id="thead">
      <tr id="0"></tr>
   </thead>
   <tbody id="tbody"></tbody>
   <tfoot>
      <tr>
         <td colspan="4" style="text-align: left; padding-left: 10px;">TOTAL:</td>
         <td style="text-align: left; padding-left: 10px;"><span id="showQantity"></span></td>
         <td style="text-align: left; padding-left: 10px;"><span>&#x20AC;&#160;</span><span id="showPrice_EUR"></span></td>
         <td style="text-align: left; padding-left: 10px;"><span>&#x20AC;&#160;</span><span id="showAmount_EUR"></span></td>
         <td style="text-align: left; padding-left: 10px;"><span>&#x20bd;&#160;</span><span id="showAmount_RUB"></span></td>
         <td style="text-align: center;"><button onclick="calculator()">Пересчитать</button></td>
      </tr>
   </tfoot>
</table>
<br><br><br>
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
   var data = [
      [
         'Nr',              // 0
         'Description',     // 1
         'Description_RUS', // 2
         'Country',         // 3
         'Qantity',         // 4
         'Price_EUR',       // 5
         'Amount_EUR',      // 6
         'Amount_RUB',      // 7
      ]
   ];

   var dataMatrix = {
      'Nr': 0,              // 0
      'Description': 1,     // 1
      'Description_RUS': 2, // 2
      'Country': 3,         // 3
      'Qantity': 4,         // 4
      'Price_EUR': 5,       // 5
      'Amount_EUR': 6,      // 6
      'Amount_RUB': 7,      // 7
   };

   // объект Отправитель / Получатель
   var sendData = {
      'date_date': '',
      'from_data': '',
      'seller_name': '',
      'buyer_name': '',
      'seller_street': '',
      'buyer_street': '',
      'seller_coutry': '',
      'buyer_coutry': '',
   };

   var Nr = document.getElementById('Nr');
   var Description = document.getElementById('Description');
   var Description_RUS = document.getElementById('Description_RUS');
   var Country = document.getElementById('Country');
   var Qantity = document.getElementById('Qantity');
   var Price_EUR = document.getElementById('Price_EUR');
   var Amount_EUR = document.getElementById('Amount_EUR');
   var Amount_RUB = document.getElementById('Amount_RUB');

   var showQantity = document.getElementById('showQantity');
   var showPrice_EUR = document.getElementById('showPrice_EUR');
   var showAmount_EUR = document.getElementById('showAmount_EUR');
   var showAmount_RUB = document.getElementById('showAmount_RUB');

   // полностью переписать
   function allAdd() {
      let head = document.getElementById('0');
      let tbody = document.getElementById('tbody');

      for (let key in data) {
         if(key != 0) {
            let row = document.createElement('tr');
            row.id = String(key);
            data[key][0] = key;

            data[key].forEach((value, k) => {
               let col = document.createElement('td');
               if(k == 4 || k == 5 || k == 6 || k == 7) {
                  let input = document.createElement('input');
                  input.type = 'number'
                  input.name = data[0][k];
                  input.value = value;
                  input.setAttribute('oninput', 'changes(' +  key + ', "' + data[0][k] + '", this)');
                  col.append(input)
                  row.append(col);
               }
               else {
                  if(k != 0) {
                     let textarea = document.createElement('textarea');
                     textarea.type = 'number'
                     textarea.name = data[0][k];
                     textarea.value = value;
                     textarea.setAttribute('oninput', 'changes(' +  key + ', "' + data[0][k] + '", this)');
                     col.append(textarea);
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
      calculator();
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
               input.name = data[0][key];
               input.value = value;
               input.setAttribute('oninput', 'changes(' +  newRow[0] + ', "' + data[0][key] + '", this)');
               col.append(input);
            }
            else {
               let textarea = document.createElement('textarea');
               textarea.name = data[0][key];
               textarea.innerHTML = value;
               textarea.setAttribute('oninput', 'changes(' +  newRow[0] + ', "' + data[0][key] + '", this)');
               col.append(textarea);
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

      calculator();
   }

   // данные для нового поля
   function rowCreate() {
      let ic = inputCheck();
      if(ic !== 'ok') {
         alert(ic);
         return;
      }

      let newRow = [];
      newRow.push(
         Nr.innerHTML,
         Description.value,
         Description_RUS.value,
         Country.value,
         Qantity.value,
         Price_EUR.value,
         Amount_EUR.value,
         Amount_RUB.value
      );

      data.push(newRow); // херачим данные в главный массив

      newAdd(newRow); // передаем данные для нового поля

      // очшщаем форму ввода и увеличиваем в ней Nr
      let NrPlus = Nr.innerHTML;
      Nr.innerHTML = ++NrPlus;
      Description.value = '';
      Description_RUS.value = '';
      Country.value = '';
      Qantity.value = '';
      Price_EUR.value = '';
      Amount_EUR.value = '';
      Amount_RUB.value = '';
   }

   function inputCheck() {
      if (Qantity.value === '') {return 'Поле Qantity должно быть числом или числом с точкой и не содержать пробелов'}
      if (Price_EUR.value === '') {return 'Поле Price_EUR должно быть числом или числом с точкой и не содержать пробелов'}
      if (Amount_EUR.value === '') {return 'Поле Amount_EUR должно быть числом или числом с точкой и не содержать пробелов'}
      if (Amount_RUB.value === '') {return 'Поле Amount_RUB должно быть числом или числом с точкой и не содержать пробелов'}
      return 'ok';
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
      allAdd();
   }

   // удаляем все записи кроме основной с нулевым айди
   function deleteAll() {
      document.getElementById('0').innerHTML = '';
      document.getElementById('tbody').innerHTML = '';
      document.getElementById('Nr').innerHTML = 1;
      data.splice(1);
      allAdd();
      totalReset();
   }

   // калькулятор
   // 4 Qantity = 0;
   // 5 Price_EUR = 0;
   // 6 Amount_EUR = 0;
   // 7 Amount_RUB = 0;
   function calculator(all = true) {
      res = [0,0,0,0];

      if(all) {
         data.forEach((value, key) => {
            if(key != 0) {
               res = [
                  res[0] + Number(value[4]),
                  res[1] + Number(value[5]),
                  res[2] + Number(value[6]),
                  res[3] + Number(value[7])
               ];
            }
         });
      }

      totalReset(res);
   }

   // обнуляем | выставляем цены
   function totalReset(res = [0,0,0,0]) {
      showQantity.innerHTML = res[0];
      showPrice_EUR.innerHTML = res[1];
      showAmount_EUR.innerHTML = res[2];
      showAmount_RUB.innerHTML = res[3];
   }

   // изменения в инпуте
   function changes(Nr, name, e) {
      if(name == 'Qantity' || name == 'Price_EUR' || name == 'Amount_EUR' || name == 'Amount_RUB') {
         if(e.value === '') {
            alert('Поле ' + name + ' должно быть числом или числом с точкой и не содержать пробелов');
            e.value = data[Nr][dataMatrix[name]];
            calculator();
            return;
         }
         else {
            data[Nr][dataMatrix[name]] = e.value;
            calculator();
         }
      }
      else {
         data[Nr][dataMatrix[name]] = e.value;
      }
   }

   // первичная отрисовка
   function add(Nr) {
      allAdd()
      document.getElementById('Nr').innerHTML = Nr;
      totalReset();
   }

   // меняем значение объекта Отправитель / Получатель по ключу
   document.querySelectorAll('#sendData').forEach(input => {
      input.addEventListener('input', (e) => {
         Object.defineProperty(sendData, e.target.name, {
            value: e.target.value,
         });
      });
   });

   window.onload = add(1);
</script>
</body>
</html>