var chart1 = document.getElementById('UltimeVendite');
var chart2 = document.getElementById('reparti');
var chart3 = document.getElementById('payment');
var dateSelect = document.querySelector('#DateSelect');
var sessionId = document.querySelector('#sessionId');
var shopid = document.querySelector('#shopid');
var tillid = document.querySelector('#tillid');
var totalday = document.querySelector('#totalday');
var divList = document.getElementById('mainlist');

let shop_till = '0';

if ( shopid ){
    shop_till = 'shop_'+shopid.value;
}else if (tillid){
    shop_till = 'till_'+tillid.value;
}

function vis_data(data){    
    return data.substr(8,2)+'/'+data.substr(5,2);
}

fetch('/api/chart/1/'+dateSelect.value+'/'+shop_till)
.then( (response) => { return response.json(); })
.then( (resp) =>{
    let label = [];
    let date = [];
    resp.forEach(element => {   
        label.push(vis_data(element['newdata']));
        date.push(element['prezzo']);
    });
    new Chart(chart1, {
        type: 'line',
        data: {
            labels: label,
            datasets: [{                        
                    label: "Incasso",
                    lineTension: 0.3,
                    backgroundColor: "rgba(0, 97, 242, 0.05)",
                    borderColor: "rgba(0, 97, 242, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(0, 97, 242, 1)",
                    pointBorderColor: "rgba(0, 97, 242, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(0, 97, 242, 1)",
                    pointHoverBorderColor: "rgba(0, 97, 242, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: date
                
            }]        
        },
        options: {        
            plugins: {
                legend: {
                    display: false
                },            
            },
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
        }
    });    
});

   

fetch('/api/chart/2/'+dateSelect.value+'/'+shop_till)
.then( (response) => { return response.json(); })
.then( (resp) =>{
    let label = [];
    let date = [];
    resp.forEach(element => {   
        label.push(element['descrizione'].substr(0,7));
        date.push(element['totale']);
    });     
    new Chart(chart2, {
        type: 'bar',
        data: {
            labels: label,
            datasets: [{
                label: "Importo",                                
                data: date,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                  ],
                  borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                  ],
                  borderWidth: 1                
            }]    
        },
        options: {        
            plugins: {
                legend: {
                    display: false
                },            
            }            
        }
    });

});

function AddListPayment(payment){    
    let div1 = document.createElement('div');
    div1.classList.add('list-group-item');
    div1.classList.add('d-flex');
    div1.classList.add('align-items-center');
    div1.classList.add('justify-content-between');
    div1.classList.add('small');
    div1.classList.add('px-0');
    div1.classList.add('py-2');
    let div2 = document.createElement('div');
    div2.innerHTML = payment['descrizione'];
    let i = document.createElement('i');
    i.classList.add('me-1');
    div1.appendChild(div2);
    let div3 = document.createElement('div');
    div3.classList.add('fw-500');
    div3.classList.add('text-dark');    
    let imp = ((100 * parseFloat(payment['totale'])) / parseFloat(totalday.innerHTML.replace(',','.'))) ;    
    div3.innerHTML = imp.toFixed(2) + ' %';
    div1.appendChild(div3);
    divList.appendChild(div1);
}

fetch('/api/chart/3/'+dateSelect.value+'/'+shop_till)
.then( (response) => { return response.json(); })
.then( (resp) =>{
    let label = [];
    let date = [];
    resp.forEach(element => {   
        label.push(element['descrizione']);
        date.push(element['totale']);
        AddListPayment(element);
    });
    new Chart(chart3, {
        type: 'doughnut',
        data: { 
            labels: label,
            datasets: [{                
                data: date,
                backgroundColor: [
                  'rgb(255, 99, 132)',
                  'rgb(54, 162, 235)',
                  'rgb(255, 205, 86)',
                  'rgb(255, 45, 23)'
                ],
                // hoverBackgroundColor: [
                //     "rgba(0, 97, 242, 0.9)",
                //     "rgba(0, 172, 105, 0.9)",
                //     "rgba(88, 0, 232, 0.9)"
                // ],
                // hoverBorderColor: "rgba(234, 236, 244, 1)",
                hoverOffset: 4
              }]
        },
        options: {        
            plugins: {
                legend: {
                    display: false
                },                            
            },
            elements: {
                arc:{
                  borderWidth: 2,
                  borderRadius:10                 
                }
            }            
        }                    
    });
});   