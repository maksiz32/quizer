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
        <span class="form-title">Add your phone number</span>
        <h3>Option 1. Add your phone number</h3>
        <label for="phone">Enter your PHONE:</label>
        <input type="text" name="phone" class="form-textfield" required>
        
        <label for="mail">Enter your e-mail *:</label>
        <input type="text" name="mail" class="form-textfield" required>

        <span>You will be able to retrive your phone number later on using your e-mail.</span>

        <button type="submit" id="send">Submit</button>
    </form>

    <script>
        const send = document.getElementById('send');
        send.addEventListener('click', function(ev) {
            const phone = document.getElementsByName('phone')[0].value;
            const mail = document.getElementsByName('mail')[0].value;
            ev.preventDefault();
            if(phone !=='' && mail !== '') {
                req = {
                    'phone': phone,
                    'mail': mail
                };
                (
                    async function() {
                        let resp = await fetch('note', {
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
                            const outBlock = `<span class="informer info">${answer.mes}</span>`;
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