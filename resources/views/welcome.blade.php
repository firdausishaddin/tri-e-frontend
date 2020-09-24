<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: black;
        }

        * {
            box-sizing: border-box;
        }

        /* Add padding to containers */
        .container {
            padding: 16px;
            background-color: white;
        }

        /* Full-width input fields */
        input[type=text],
        input[type=password],
        select {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
        }

        input[type=text]:focus,
        input[type=password]:focus,
        select:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Overwrite default styles of hr */
        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        /* Set a style for the submit button */
        .submitbtn {
            background-color: #4CAF50;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        .submitbtn:hover {
            opacity: 1;
        }

        /* Add a blue text color to links */
        a {
            color: dodgerblue;
        }

        /* Set a grey background color and center the text of the "sign in" section */
        .signin {
            background-color: #f1f1f1;
            text-align: center;
        }
    </style>
</head>

<body>

    <form>
        <div class="container">
            <h1>Tri E</h1>
            <p>Simple Form.</p>
            <hr>

            <label for="email"><b>Digit</b></label>
            <input type="text" id="digit" name="digit" />
            <!-- <select id="digit" name="digit">
                <!-- <option disabled selected>Please Select Digit</option>
                <option value="50000">50,000</option> -->
                <!-- <option value="100000">100,000</option>
                <option value="150000">150,000</option> -->
            <!-- </select>  -->

            <button type="button" id="start" class="submitbtn">Submit</button>

            <!-- <input type="text" placeholder="Timer" name="timer" id="timer" disabled> -->

            <hr>

            <div align="center">
                <output id="display-area">00:00:00.000</output>
            </div>
            <div align="center">
                <button id="toggle-button" type="button">Start</button>
                <button id="stop-button" type="button">Stop</button>
                <button id="reset-button" type="button">Reset</button>
            </div>
        </div>

    </form>

</body>

</html>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
    var timeBegan = null,
        timeStopped = null,
        stoppedDuration = 0,
        started = null;

    startTimer = () => {
        if (timeBegan === null) {
            timeBegan = new Date();
        }

        if (timeStopped !== null) {
            stoppedDuration += (new Date() - timeStopped);
        }

        started = setInterval(clockRunning, 10);
    }

    stopTimer = () => {
        timeStopped = new Date();
        clearInterval(started);
    }

    $("#toggle-button").on("click", function() {
        startTimer()
    })

    $("#stop-button").on("click", function() {
        stopTimer()
    })

    $("#reset-button").on("click", function() {
        clearInterval(started);
        stoppedDuration = 0;
        timeBegan = null;
        timeStopped = null;
        document.getElementById("display-area").innerHTML = "00:00:00.000";
    })

    clockRunning = () => {
        var currentTime = new Date(),
            timeElapsed = new Date(currentTime - timeBegan - stoppedDuration),
            hour = timeElapsed.getUTCHours(),
            min = timeElapsed.getUTCMinutes(),
            sec = timeElapsed.getUTCSeconds(),
            ms = timeElapsed.getUTCMilliseconds();

        document.getElementById("display-area").innerHTML =
            (hour > 9 ? hour : "0" + hour) + ":" +
            (min > 9 ? min : "0" + min) + ":" +
            (sec > 9 ? sec : "0" + sec) + "." +
            (ms > 99 ? ms : ms > 9 ? "0" + ms : "00" + ms);
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#start').on('click', function() {
        var formData = new FormData(document.querySelector("form"));
        startTimer();

        Swal.fire({
            title: 'Data is being processed. Please wait...',
            onOpen: function() {
                Swal.showLoading();
                $.ajax({
                    url: "{{ route('home.store') }}",
                    processData: false,
                    contentType: false,
                    data: formData,
                    type: 'POST',
                    success: ((response) => {
                        let json = JSON.parse(response);

                        if (json.success) {
                            stopTimer();
                            Swal.fire({
                                icon: 'success',
                                title: json.message,
                                showConfirmButton: true,
                            }).then(() => {
                                // clearInterval(counter);
                            });
                        } else {
                            stopTimer();
                            Swal.fire({
                                icon: 'error',
                                title: json.message,
                                showConfirmButton: true,
                            })
                        }
                    }),
                    fail: (json) => {
                        Swal.fire(
                            'Opps!',
                            'An error occurred, we are sorry for inconvenience.',
                            'danger'
                        )
                    }
                })
            }
        })
    });
</script>