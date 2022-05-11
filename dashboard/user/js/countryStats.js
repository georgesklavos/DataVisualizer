//Select the required elements from the DOM
let selectedCountry = document.getElementById("usersCountry").innerHTML;
const selectedFrom = document.getElementById("fromPeriod");
const selectedTo = document.getElementById("toPeriod");
const searchButton = document.getElementById("searchForData");
const loader = document.getElementById("loader");

//Declare global values
let resultSummary = {};
let map;

//Check if all the inputs have a value to enable to disable the button
function checkForSelectedData() {
  searchButton.disabled =
    (selectedFrom.value != "" && selectedTo.value != "") == true ? false : true;
}

//Change event for the select from date
selectedFrom.addEventListener("change", function () {
  checkForSelectedData();
  selectedTo.disabled = false;
  selectedTo.setAttribute("min", selectedFrom.value);
});

//Change event for the select to date
selectedTo.addEventListener("change", function () {
  checkForSelectedData();
});

//Initialize bar chart
function loadTotalBarChart() {
  const checkBarChart = Chart.getChart("totalSummaryBarChart");
  //Check if the bar bar chart exists and destroy it
  if (checkBarChart != undefined) {
    checkBarChart.destroy();
  }

  //Total bar chart labels
  const totalLabels = ["Total confirmed", "Deaths"];

  //Total bar chart data
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
  //Check if the line chart exists and destroy it
  if (checkLineChart != undefined) {
    checkLineChart.destroy();
  }

  let labels = [];
  let confirmedDataset = [];
  let deathsDataset = [];

  //Create the data for line chart
  resultSummary.covidData.forEach((el) => {
    let date = new Date(el.Date);
    labels.push(date.toLocaleDateString("en-US"));
    confirmedDataset.push(el.Confirmed);
    deathsDataset.push(el.Deaths);
  });

  //Load the data for the line chart
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

  //Config for the line chart
  const totalConfig = {
    type: "line",
    data: totalData,
    options: {
      responsive: true,
      maintainAspectRatio: false,
    },
  };

  //Create the line chart
  const lineChart = new Chart(
    document.getElementById("summaryLineChart"),
    totalConfig
  );
}

//Initialize the map
function loadMap() {
  //Check if the map exists and destroy it
  if (map) {
    map.remove();
  }
  //Create the map
  map = L.map("countryMap").setView([39.07, 21.82], 2);
  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution:
      '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
  }).addTo(map);

  //Load geojson for the selected country and adjust the bounds of the map
  let geoJson = L.geoJSON(resultSummary.location.geojson).addTo(map);
  map.fitBounds(geoJson.getBounds());
}

//Click event for the search button
searchButton.addEventListener("click", async function () {
  //Show loader
  loader.hidden = false;
  //Api call to our back end that retrives the required values for the page
  await fetch(
    `/api/summary/countrySummary.php?countryId=${selectedCountry}&from=${selectedFrom.value}&to=${selectedTo.value}`
  )
    .then((res) => res.json())
    .then((data) => {
      resultSummary = data;
    });

  //Create the charts and the map
  loadTotalBarChart();
  loadMap();
  loadLineChart();

  //Hide loader
  loader.hidden = true;
});
