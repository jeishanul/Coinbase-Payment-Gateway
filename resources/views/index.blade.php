<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coin Base</title>
</head>
<style>
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    input {
        height: 2rem;
        border: 1px solid #e3e3e3;
        border-radius: 5px;
        padding: 5px 15px;
    }

    input:focus {
        outline: none !important;
        border-color: #719ECE;
        box-shadow: 0 0 10px #719ECE;
    }

    button {
        background-color: #585883;
        padding: 11px 25px;
        color: #ffffff;
        font-size: 15px;
        font-weight: 600;
        border: 1px solid #585883;
        border-radius: 5px;
    }

    button:hover {
        background-color: #5252a3;
        border: 1px solid #5252a3;
    }

    .error-message {
        position: absolute;
        margin-bottom: 100px;
        color: red;
        background-color: #ff00001c;
        padding: 10px 20px;
        border-radius: 5px;
    }

    span {
        position: absolute;
        margin-top: 52px;
        margin-left: -213px;
        color: red;
    }
</style>

<body>
    <div class="container">
        @if (session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('payment.process') }}" method="post">
            @csrf
            <input type="number" name="amount" placeholder="Enter your amount">
            @error('amount')
                <span>{{ $message }}</span>
            @enderror
            <button type="submit">Pay</button>
        </form>
    </div>
</body>

</html>
