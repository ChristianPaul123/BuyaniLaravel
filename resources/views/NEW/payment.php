Payment

(Route Start)
	Route::get('/payment', [PaymentController::class, 'index'])->middleware('auth');
	Route::post('/payment/store', [PaymentController::class, 'store'])->name('payment.store');
(Route End)







(View Start)
//Specify mo nalang route gusto mong route for purpose only this
	    <form action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data" class="admin-form">
                    @csrf

                    <div class="form-group">
                        <label for="photo">Change QR Photo</label>
                        <input class="form-control" name="photo" type="file" id="photo">
                    </div>
                    <div class="form-group text-center">
                    <br>
                        <a href="/home" class="btn btn-warning">Return Home</a>
                        <button type="submit" class="btn btn-primary">Change QR Code</button>
                    </div>

                </form>
(View End)








(Model Start)
  	  protected $table = 'qrcode'; //Specify mo kung ano ang name ng table mo s database
 	  protected $fillable = ['photo'];
(Model End)









(Migration Start)
	 Schema::create('qrcode', function (Blueprint $table) {
            $table->id('Attemp_Id');
            $table->string('photo', 300)->nullable();
            $table->timestamps();
        });
(Migration End)








(Controller Start)
    public function index()
    {
        $qrscan = Qrcode::latest()->first();
        return view('page.payment', compact('qrscan'));
    }

    public function create()
    {
        $qrscan = Qrcode::latest()->first();
        return view('page.payment', compact('qrscan'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload for the new photo
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads/qrcode', $filename); // Save in storage/app/public/uploads/qrcode, pero pwede naman mo ito iedit sa mas prefer mo sa path location

            // Create a new QR code record
            $qrscan = new Qrcode();
            $qrscan->photo = $filename;
            $qrscan->save(); // Save the new QR code record
        }

        // Redirect back with a success message
        return redirect()->route('payment.create')->with('success', 'QR Code uploaded successfully!');
    }
(Controller End)
