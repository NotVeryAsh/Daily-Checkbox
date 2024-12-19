<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        Daily Checkbox
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="app.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
    <body class="flex flex-col">
        <form id="form" action="/check" method="POST" class="flex flex-col m-auto">
            @csrf
            <div id="leaderboard" class="flex flex-col absolute top-5 right-5 bg-white rounded-lg h-1/4 lg:w-96 w-72 p-4">
                <p class="text-center text-2xl font-bold mb-3">Leaderboards</p>
                <div>
                    @foreach($checks as $check)
                        <div class="font-medium text-xl">
                            {{$check->name}} - {{$check->count}}
                        </div>
                    @endforeach
                </div>
                <div class="w-full mt-auto">
                    <input <?php echo $hideCheck ? "disabled" : "" ?> value="{{ $name }}" class="p-2 rounded-lg w-full bg-gray-100" id="name" type="text" name="name" placeholder="Name..." required maxlength="16">
                </div>
            </div>
            <div class="flex flex-col space-y-20">
                <p id="text" class="text-2xl font-bold">
                    <?php echo $hideCheck ? "Come back tomorrow!" : "Check the box!" ?>
                </p>
                <input class="flex max-w-20 mx-auto" id="check" type="checkbox" <?php echo $hideCheck ? "disabled" : "" ?> onchange="onSubmit()">
            </div>
            <button id="submit" class="hidden" type="submit"></button>
        </form>
        <script>
            function onSubmit() {
                console.log(document.getElementById("name").value);
                if(document.getElementById("name").value === "" || document.getElementById("name").value === null) {
                    document.getElementById("check").checked = false;
                } else {
                    document.getElementById("check").classList.add("disabled");
                }
                document.getElementById("submit").click()
            }
        </script>
    </body>
</html>
