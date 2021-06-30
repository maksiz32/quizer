<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/main.css" rel="stylesheet">
    <title><?=$pageName?></title>
</head>
<body>
    <form class="form">
        <span class="form-title">Retrieve your phone number</span>
        <h3>Option 2. Retrieve your phone number</h3>
        
        <label for="mail">Enter your e-mail *:</label>
        <input type="text" name="mail" class="form-textfield" required>

        <span>The phone number will be e-mailed to you.</span>

        <button type="submit" id="send">Submit</button>
    </form>

<script>
    const send = document.getElementById('send');
    send.addEventListener('click', function(ev) {
        const mail = document.getElementsByName('mail')[0].value;
        ev.preventDefault();
        if(mail !== '') {
            req = {
                'mail': mail
            };
            (
                async function() {
                    let resp = await fetch('phone', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json;charset=utf-8'
                        },
                        body: JSON.stringify(req)
                    })
                    const answer = await resp.json();
                    if (answer.res !== 0) {
                        let informer = document.querySelector('.informer');
                        if(informer) {
                            informer.parentNode.removeChild(informer);
                        }
                        const outBlock = `<span class="informer info">Привязанные номера:  ${answer.mes}</span>`;
                        document.querySelector('.form').insertAdjacentHTML('beforeEnd', outBlock);
                    } else {
                        let informer = document.querySelector('.informer');
                        if(informer) {
                            informer.parentNode.removeChild(informer);
                        }
                        const outBlock = `<span class="informer alert">${answer.error}</span>`;
                        document.querySelector('.form').insertAdjacentHTML('beforeEnd', outBlock);
                    }
                }
            )();
        }
    });
</script>
</body>
</html>