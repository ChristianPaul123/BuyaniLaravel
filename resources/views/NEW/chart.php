Charts

(Route Start)
Route::get('/home/user-profile/report', [CertificateController::class, 'showReport'])->middleware('auth');
(Route End)





(View Start)
<head>
<style>
    .report-container {
        margin-top: 30px;
        margin-bottom: 30px;
        flex-wrap: wrap;
        justify-content: center;
        background-color: #e8f7ec;
        padding: 20px;
        max-width: 1300px;
        gap: 20px;
        margin-left: auto;
        margin-right: auto;
    }

    .pie-container, .bar-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
        max-width: 850px;
        padding: 20px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        background-color: #28a745;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 50px;
    }

    #piechart, #top_x_div {
        width: 100%;
        height: 400px;
    }

    h1 {
        text-align: center;
        font-size: 2em;
        margin-top: 40px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    h2 {
        text-align: center;
        color: #E8F7EC;
        font-size: 1.3em;
        margin-top: 20px;
        margin-bottom: 20px;
        font-weight: bold;
    }

    @media only screen and (max-width: 768px) {
        .report-container {
            flex-direction: column;
            padding: 10px;
            gap: 15px;
        }

        .pie-container, .bar-container {
            width: 90%;
            padding: 10px;
            margin-bottom: 30px;
        }

        #piechart, #top_x_div {
            height: 150px;
            width: 75%;
        }

        h1 {
            font-size: 1.5em;
        }

        h2 {
            font-size: 1.2em;
        }
    }
</style>
</head>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    // Load Pie Chart Start
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawPieChart);

    function drawPieChart() {
        var pieData = new google.visualization.DataTable();
        pieData.addColumn('string', 'Certificate Type');
        pieData.addColumn('number', 'Total Issued');
        /*
        - The '$certificate' variable came from the Controller which uses compact to pass data from controller to view
        - Cert_Type is the attribute/column in database table that the chart checks (does count the quantity of that specific field value)
        */
        @foreach($certificates as $certificate)
            pieData.addRow(['{{ $certificate->Cert_Type }}', {{ $certificate->total_quantity }}]);
        @endforeach

        var pieOptions = {
            title: '', // Change the Title if Needed, this is located in the left side of the container
            pieHole: 0.4,
            colors: ['#bce7c8', '#90d7a4', '#4ebf6e'] //You can change the color of the column of the pie chart here
        };

        var pieChart = new google.visualization.PieChart(document.getElementById('piechart')); //Thsi refer to the container in the Html div
        pieChart.draw(pieData, pieOptions);
    }
// Load Pie Chart End

 // Load Bar Chart Start
 google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawBarChart);



    //The 'certificate2' is compacted from the controller
    function drawBarChart() {
        var barData = google.visualization.arrayToDataTable([
            ['Certificate Type', 'Total Issued'],
            @foreach($certificate2 as $cert) /*$certificate2 is passed on $cert variable so now cert has the data in the field value in database*/
                ['{{ $cert->certs }}', {{ $cert->total_quantity }}],
            @endforeach
        ]);

        var barOptions = {
            width: 800,
            legend: { position: 'none' },
            chart: {
                title: '', //
                subtitle: '' //
            },
            axes: {
                x: {
                    0: { side: 'top', label: 'Certificate Type' } //You can change the centered label of the chart
                }
            },
            bar: { groupWidth: "90%" }
        };

        var barChart = new google.charts.Bar(document.getElementById('top_x_div'));
        barChart.draw(barData, google.charts.Bar.convertOptions(barOptions));
    }
// Load Bar Chart End
</script>

<body>
<div class="report-container"> <!--Here is where the container for the charts-->
    <center>
        <h1>Weekly Certificates Report</h1>
    </center>
    <div class="pie-container">
        <h2>Issued Certificates by Users</h2>
        <div id="piechart" class="pieclass"></div>
    </div>
    <div class="bar-container">
        <h2>Issued Certificates by Percentage</h2>
        <div id="top_x_div" class="barclass"></div>
    </div>
</div>
</body>
(View End)







(Migration Start)
      Schema::create('transactions', function (Blueprint $table) {
            $table->id('Transaction_Id');
            $table->unsignedBigInteger('User_Id');
            $table->unsignedBigInteger('Certificate_Id');
            $table->date('Submitted_Date');
            $table->date('Pick_Up_Date');
            $table->string('Cert_Type', 255);
            $table->integer('Quantity');
            $table->unsignedBigInteger('Request_Id');
            $table->string('User_Appointment')->nullable();
            $table->enum('Status', ['Pending', 'Confirmed']);
            $table->enum('progress', ['Ongoing', 'Completed'])->default('Ongoing');
            $table->timestamps();
            $table->foreign('User_Id')->references('User_Id')->on('users');
            $table->foreign('Certificate_Id')->references('Certificate_Id')->on('certificates');
        });
(Migration End)








(Model Start)
    protected $table = 'transactions';   //Define if anong table tiga select mo
    public $timestamps = true; //If meron ka nang created_at nd updated_at di mo na nito kailangan
    protected $fillable = [
        'User_Id',
        'Certificate_Id',
        'Submitted_Date',
        'Pick_Up_Date',
        'Cert_Type',
        'Quantity',
        'Request_Id',
        'Status',
        'progress',
    ];
(Model End)












(Controller Start)
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use DB;

class CertificateController extends Controller
{
    public function showReport()
    {
        // Pie chart data: certificates issued
        $certificates = Transaction::where('progress', 'Ongoing')
            ->select('Cert_Type', DB::raw('SUM(Quantity) as total_quantity'))
            ->groupBy('Cert_Type')
            ->get();

        // Bar chart data: Correctly summing quantities for the bar chart
        $certificate2 = Transaction::select('Cert_Type as certs', DB::raw('SUM(Quantity) as total_quantity'))
            ->groupBy('Cert_Type')
            ->get();

        return view('page.report', [
            'certificates' => $certificates,
            'certificate2' => $certificate2,
        ]);
    }

}
(Controller End)
