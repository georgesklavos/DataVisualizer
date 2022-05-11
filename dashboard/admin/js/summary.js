//Select the requirement elements from the DOM
let selectedCountry = document.getElementById("countrySummary");
const selectedFrom = document.getElementById("fromPeriod");
const selectedTo = document.getElementById("toPeriod");
const searchButton = document.getElementById("searchForData");
const loader = document.getElementById("loader");
//Create global variables
let resultSummary = {};
let map;

//Check if the required fields have values
function checkForSelectedData() {
  searchButton.disabled =
    (selectedCountry != "Choose a country" &&
      selectedFrom.value != "" &&
      selectedTo.value != "") == true
      ? false
      : true;
}

//Change event for the from date
selectedFrom.addEventListener("change", function () {
  checkForSelectedData();
  selectedTo.disabled = false;
  selectedTo.setAttribute("min", selectedFrom.value);
});

//Change event for the to date
selectedTo.addEventListener("change", function () {
  checkForSelectedData();
});

//Initialize bar chart
function loadTotalBarChart() {
  const checkBarChart = Chart.getChart("totalSummaryBarChart");

  //Check if bar chart exists and destroy it
  if (checkBarChart != undefined) {
    checkBarChart.destroy();
  }

  //Total bar chart labels
  const totalLabels = ["Total confirmed", "Deaths"];

  //Load total bar chart data
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

  //Total bar chart config
  const totalConfig = {
    type: "bar",
    data: totalData,
    options: {},
  };

  //Create bar chart
  const totalBarChart = new Chart(
    document.getElementById("totalSummaryBarChart"),
    totalConfig
  );
}

//Initialize line chart
function loadLineChart() {
  const checkLineChart = Chart.getChart("summaryLineChart");

  //Check if line chart exists end destroy it
  if (checkLineChart != undefined) {
    checkLineChart.destroy();
  }

  let labels = [];
  let confirmedDataset = [];
  let deathsDataset = [];

  //Create line chart data
  resultSummary.covidData.forEach((el) => {
    let date = new Date(el.Date);
    labels.push(date.toLocaleDateString("en-US"));
    confirmedDataset.push(el.Confirmed);
    deathsDataset.push(el.Deaths);
  });

  //Line chart labels
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

  //Line chart config
  const totalConfig = {
    type: "line",
    data: totalData,
    options: {
      responsive: true,
      maintainAspectRatio: false,
    },
  };

  //Create line chart
  const lineChart = new Chart(
    document.getElementById("summaryLineChart"),
    totalConfig
  );
}

//Create map
function loadMap() {
  //Check if map exists end destroy it
  if (map) {
    map.remove();
  }
  map = L.map("countryMap").setView([39.07, 21.82], 2);
  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution:
      '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
  }).addTo(map);

  //Load geojson data for the selected country and adjust the bounds of the map
  let geoJson = L.geoJSON(resultSummary.location.geojson).addTo(map);
  map.fitBounds(geoJson.getBounds());
}

searchButton.addEventListener("click", async function () {
  loader.hidden = false;
  //Fetch the data for the country summary
  await fetch(
    `/api/summary/countrySummary.php?countryId=${selectedCountry.value}&from=${selectedFrom.value}&to=${selectedTo.value}`
  )
    .then((res) => res.json())
    .then((data) => {
      resultSummary = data;
    });

  //Create bar, line chart and the map
  loadTotalBarChart();
  loadMap();
  loadLineChart();
  loader.hidden = true;
});
