let selectedCountry = document.getElementById("countrySummary");
const selectedFrom = document.getElementById("fromPeriod");
const selectedTo = document.getElementById("toPeriod");
const searchButton = document.getElementById("searchForData");
const loader = document.getElementById("loader");
let resultSummary = {};
let map;

function checkForSelectedData() {
  searchButton.disabled =
    (selectedCountry != "Choose a country" &&
      selectedFrom.value != "" &&
      selectedTo.value != "") == true
      ? false
      : true;
}

selectedFrom.addEventListener("change", function () {
  checkForSelectedData();
  selectedTo.disabled = false;
  selectedTo.setAttribute("min", selectedFrom.value);
});

selectedTo.addEventListener("change", function () {
  checkForSelectedData();
});

function loadTotalBarChart() {
   const checkBarChart =  Chart.getChart("totalSummaryBarChart");
    if (checkBarChart != undefined) {
        checkBarChart.destroy();
      }
  //Total bar chart

  const totalLabels = ["Total confirmed", "Deaths"];

  const totalData = {
    labels: totalLabels,
    datasets: [
      {
        label: "Total data",
        backgroundColor: "rgb(0, 14, 194)",
        borderColor: "rgb(0, 0, 0)",
        data: [resultSummary.total.Confirmed, resultSummary.total.Deaths],
      },
    ],
  };

  const totalConfig = {
    type: "bar",
    data: totalData,
    options: {},
  };

  const totalBarChart = new Chart(
    document.getElementById("totalSummaryBarChart"),
    totalConfig
  );
}

function loadLineChart() {
    const checkLineChart =  Chart.getChart("summaryLineChart");
    if (checkLineChart != undefined) {
        checkLineChart.destroy();
      }
  //Line chart

  let labels = [];
  let confirmedDataset = [];
  let deathsDataset = [];

  resultSummary.covidData.forEach((el) => {
    let date = new Date(el.Date);
    labels.push(date.toLocaleDateString("en-US"));
    confirmedDataset.push(el.Confirmed);
    deathsDataset.push(el.Deaths);
  });

  const totalData = {
    labels,
    datasets: [
      {
        label: "Confirmed",
        fill: false,
        borderColor: "rgb(75, 192, 192)",
        tension: 0.1,
        data: confirmedDataset,
      },
      {
        label: "Deaths",
        fill: false,
        borderColor: "rgb(240 0 20)",
        tension: 0.1,
        data: deathsDataset,
      },
    ],
  };

  const totalConfig = {
    type: "line",
    data: totalData,
    options: {
      responsive: true,
      maintainAspectRatio: false,
    },
  };

  const lineChart = new Chart(
    document.getElementById("summaryLineChart"),
    totalConfig
  );
}

function loadMap() {
    
    console.log(map);
    if(map) {
        map.remove();
    }
    map = L.map("countryMap").setView([39.07, 21.82], 2);
  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution:
      '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
  }).addTo(map);
  console.log(resultSummary.location.geojson);
  let geoJson = L.geoJSON(resultSummary.location.geojson).addTo(map);
  map.fitBounds(geoJson.getBounds());
}

searchButton.addEventListener("click", async function () {
  console.log("search");
  console.log(selectedCountry);
  console.log(selectedFrom.value);
  console.log(selectedTo.value);
  loader.hidden = false;
  await fetch(
    `/api/summary/countrySummary.php?countryId=${selectedCountry.value}&from=${selectedFrom.value}&to=${selectedTo.value}`
  )
    .then((res) => res.json())
    .then((data) => {
      resultSummary = data;
    });
  console.log(resultSummary);
  loadTotalBarChart();
  loadMap();
  loadLineChart();
  loader.hidden = true;
});
