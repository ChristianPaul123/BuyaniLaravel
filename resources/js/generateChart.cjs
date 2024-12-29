// const { ChartJSNodeCanvas } = require('./node_modules/chart.js');
// const fs = require('fs');

// // Canvas dimensions
// const width = 800;
// const height = 600;

// // ChartJSNodeCanvas instance
// const chartJSNodeCanvas = new ChartJSNodeCanvas({ width, height });

// async function generateChart(data) {
//     const configuration = {
//         type: 'bar', // Chart type
//         data: {
//             labels: data.labels,
//             datasets: [
//                 {
//                     label: 'Sales Data',
//                     data: data.values,
//                     backgroundColor: 'rgba(75, 192, 192, 0.2)',
//                     borderColor: 'rgba(75, 192, 192, 1)',
//                     borderWidth: 1,
//                 },
//             ],
//         },
//         options: {
//             responsive: true,
//         },
//     };

//     // Ensure output path is in the `public/charts` directory
//     const outputPath = `./public/charts/${data.filename}.png`;
//     fs.mkdirSync('./public/charts', { recursive: true }); // Ensure directory exists
//     const imageBuffer = await chartJSNodeCanvas.renderToBuffer(configuration);

//     fs.writeFileSync(outputPath, imageBuffer);
//     console.log(`Chart saved at ${outputPath}`);
// }

// // Process JSON data passed to this script
// const chartData = JSON.parse(process.argv[2]);
// generateChart(chartData).catch(console.error);
