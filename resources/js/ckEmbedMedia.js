document.querySelectorAll( 'oembed[url]' ).forEach( element => {
	//console.log(element)
	let url = element.getAttribute('url')
	var ytID = findYoutubeVideoID(url)
	var ytHtml = generateYoutubeEmbedCode(ytID, 560, 315)
	//console.log(generateYoutubeEmbedCode(url))
	element.innerHTML = ytHtml
});

function findYoutubeVideoID(url) {

	// thanks for the regexes guys!
	var YoutubeRegexObject_v1 = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i; // only gets the first VideoURL
	var YoutubeRegexObject_v2 = /(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/user\/\S+|\/ytscreeningroom\?v=|\/sandalsResorts#\w\/\w\/.*\/))([^\/&]{10,12})/;

	var YoutubeVideoID = url.match(YoutubeRegexObject_v1);

	return YoutubeVideoID[1];
}

function generateYoutubeEmbedCode(YoutubeVideoID,width,height)
{
	if(!width)
	{
		width = "854";
	}
	if(!height)
	{
		height = "510";
	}
	return '<div class="ratio ratio-16x9"><iframe src="//www.youtube.com/embed/'+YoutubeVideoID+'" frameborder="0" allowfullscreen></iframe></div>';
}

var gl = document.querySelector('.glightbox')
if(gl){
	var lightboxDescription = GLightbox({
		selector: '.glightbox'
	});    
}

import Chart from 'chart.js/auto';

document.querySelectorAll('.jdih_chart').forEach(elem => {
	if(elem){
		let jns = elem.getAttribute('data-dg-jns');
		let hukum = elem.getAttribute('data-dg-hukum');
		//let rlabel = [];

		const labels = ['0'];
		const data = {
			labels: labels,
			datasets: [{
				label: 'Berlaku',
				data: [0],
				fill: false,
				borderColor: 'rgb(75, 192, 192)',
				tension: 0.1
			}]
		};

		const config = {
			type: jns,
			data: data,
			options: {
				plugins: {},
				options: {
					responsive: true,
					maintainAspectRatio: false,
				},
			},
		};

		var chart = new Chart(elem, config);
		chart.options.plugins.legend.position = 'right';

		axios.get('/api/getDataRekap/'+hukum).then(res => {
			if(res.data.labels[1] != null){
				if(jns == 'pie'){
					chart.data = {
						labels : res.data.pie.labels,
						datasets : [{
						   data : res.data.pie.datasets.data,
						}]
					}
					
					//console.log(chart.data)
				}else{
					chart.data.labels = res.data.labels;
					chart.data.datasets = res.data.datasets;    
				}
			}
		}).catch(e => {
			console.log(e.err)
		}).finally(function(){
			chart.update();
		})
		//chart.update();
	}
});

var myPieChartPusat = document.getElementById('myPieChartPusat')
if(myPieChartPusat){
  const labels = ['0','1','2','3'];
	const data = {
		labels: labels,
		datasets: [{
			label: 'Personel PNS',
			data: [0],
			fill: false,
			borderColor: 'rgb(75, 192, 192)',
			tension: 0.1
		},{
			label: 'Personel Militer',
			data: [0],
			fill: false,
			borderColor: 'rgb(75, 192, 192)',
			tension: 0.1
		}]
	};

  const config = {
    type: 'bar',
    data: data,
    options: {
        plugins: {},
        options: {
            responsive: true,
            maintainAspectRatio: false,
        },
    },
  };

  var chart1 = new Chart(myPieChartPusat, config);

  //chart.options.plugins.legend.position = 'right';

  axios.get('/api/getRekapPersonel').then(res => {
  	//console.log(res.data)
  	const data = res.data;
  	if(data){
  		chart1.data.labels = ["Personel Per Jenis"];
		chart1.data.datasets = data.datasets; 
  	}
  	
	}).catch(e => {
		console.log(e.err)
	}).finally(function(){
		chart1.update();
	})
}

var myPieChartDaerah = document.getElementById('myPieChartDaerah')
if(myPieChartDaerah){
  const labels = ['0','1','2','3'];
	const data = {
		labels: labels,
		datasets: [{
			label: 'Laki-laki',
			data: [0],
			fill: false,
			borderColor: 'rgb(75, 192, 192)',
			tension: 0.1
		},{
			label: 'Perempuan',
			data: [0],
			fill: false,
			borderColor: 'rgb(75, 192, 192)',
			tension: 0.1
		}]
	};

  const config = {
    type: 'bar',
    data: data,
    options: {
        plugins: {},
        options: {
            responsive: true,
            maintainAspectRatio: false,
        },
    },
  };

  var chart2 = new Chart(myPieChartDaerah, config);

  //chart.options.plugins.legend.position = 'right';

  axios.get('/api/getRekapJnsHukum').then(res => {
  	const data = res.data;
  	console.log(res.data)
  	if(data){
  		chart2.data.labels = ["Personel Per Jenis Kelamin"];
		chart2.data.datasets = data.datasets; 
  	}

	}).catch(e => {
		console.log(e.err)
	}).finally(function(){
		chart2.update();
	})
}

var surveyChart = document.getElementById('surveyChart');

if(surveyChart){
	axios.get('/api/getDataSurvey/').then(res => {
		const {data, total} = res.data
		var percentage = (data[1] / total) *100
	  	//var data = res.data.data;
	  	//var total = rdata.total;

	  	//console.log(data, total)

	  	new Chart(surveyChart, {
		    type: 'doughnut',
		    data: {
		      	labels: ['Ya', 'Tidak'],
		      	datasets: [{
		        	//label: '# of Votes',
		        	data: [data[1], data[0]],
		        	backgroundColor: [
		        		'rgb(0, 0, 128)',
		        		'rgba(0, 0, 128, 0.1)',
				    ],
				    hoverOffset: 4,
		      	}]
		    },
		    options: {
			    responsive: true,
			    plugins: {
			      	legend: {
			        	display: true
			      	},
			    }
			},
		    plugins: [{
			    id: 'text',
			    beforeDraw: function(chart, a, b) {
			      var width = chart.width,
			        height = chart.height +30,
			        ctx = chart.ctx;

			      	ctx.restore();
			      	var fontSize = (height / 200).toFixed(2);
			      	ctx.font = fontSize +"em Lato";
			      	ctx.textBaseline = "middle";

			      	var text = percentage.toFixed(1) +"%",
			        textX = Math.round((width - ctx.measureText(text).width) / 2),
			        textY = height / 2;

			      	ctx.fillText(text, textX, textY);
			      	ctx.save();
			    }
			}]
		});
	}).catch(e => {
		console.log(e.err)
	})
	//surveyChart.fillText(data[0].value + "%", width/2 - 20, width/2, 200);
}