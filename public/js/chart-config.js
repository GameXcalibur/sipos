/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/js/chart-config.js ***!
  \**************************************/
$(document).ready(function () {
  var salesPurchasesBar = document.getElementById('salesPurchasesChart');
  $.get('/sales-purchases/chart-data', function (response) {
    var salesPurchasesChart = new Chart(salesPurchasesBar, {
      type: 'bar',
      data: {
        labels: response.sales.original.days,
        datasets: [{
          label: 'Tests Passed',
          data: response.sales.original.data,
          backgroundColor: ['#6366F1'],
          borderColor: ['#6366F1'],
          borderWidth: 1
        }, {
          label: 'Tests Failed',
          data: response.purchases.original.data,
          backgroundColor: ['#A5B4FC'],
          borderColor: ['#A5B4FC'],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  });
  var overviewChart = document.getElementById('currentMonthChart');
  $.get('/current-month/chart-data', function (response) {
    var currentMonthChart = new Chart(overviewChart, {
      type: 'doughnut',
      data: {
        labels: ['Online', 'Offline'],
        datasets: [{
          data: [response.sales,  response.expenses],
          backgroundColor: ['#33ff44',  '#EF4444'],
          hoverBackgroundColor: ['#33ff44',  '#EF4444']
        }]
      }
    });
  });

  var overviewChart1 = document.getElementById('testChart');
  $.get('/current-month/test-data', function (response) {
    var currentMonthChart1 = new Chart(overviewChart1, {
      type: 'doughnut',
      data: {
        labels: ['Failed', 'Passed'],
        datasets: [{
          data: [response.failed,  response.passed],
          backgroundColor: ['#EF4444',  '#33ff44'],
          hoverBackgroundColor: ['#EF4444',  '#33ff44']
        }]
      }
    });
  });


  var overviewChart2 = document.getElementById('wtestChart');
  $.get('/current-month/test-dataw', function (response) {
    var currentMonthChart2 = new Chart(overviewChart2, {
      type: 'doughnut',
      data: {
        labels: ['Failed', 'Passed'],
        datasets: [{
          data: [response.failed,  response.passed],
          backgroundColor: ['#EF4444',  '#33ff44'],
          hoverBackgroundColor: ['#EF4444',  '#33ff44']
        }]
      }
    });
  });

  var overviewChart3 = document.getElementById('mtestChart');
  $.get('/current-month/test-datam', function (response) {
    var currentMonthChart3 = new Chart(overviewChart3, {
      type: 'doughnut',
      data: {
        labels: ['Failed', 'Passed'],
        datasets: [{
          data: [response.failed,  response.passed],
          backgroundColor: ['#EF4444',  '#33ff44'],
          hoverBackgroundColor: ['#EF4444',  '#33ff44']
        }]
      }
    });
  });
  var paymentChart = document.getElementById('paymentChart');
  $.get('/payment-flow/chart-data', function (response) {
    console.log(response);
    var cashflowChart = new Chart(paymentChart, {
      type: 'line',
      data: {
        labels: response.months,
        datasets: [{
          label: 'Offline',
          data: response.payment_sent,
          fill: false,
          borderColor: '#EA580C',
          tension: 0
        }, {
          label: 'Online',
          data: response.payment_received,
          fill: false,
          borderColor: '#2563EB',
          tension: 0
        }]
      }
    });
  });
});
/******/ })()
;