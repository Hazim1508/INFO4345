document.getElementById('myForm').addEventListener('submit', function(event) {
    var name = document.getElementById('name').value;
    var matricNo = document.getElementById('matricNo').value;
    var currentAddress = document.getElementById('currentAddress').value;
    var homeAddress = document.getElementById('homeAddress').value;
    var email = document.getElementById('email').value;
    var mobilePhoneNo = document.getElementById('mobilePhoneNo').value;
    var homePhoneNo = document.getElementById('homePhoneNo').value;

    var nameRegex = /^[a-zA-Z@']*$/;
    var matricNoRegex = /^[0-9]{6}$/;
    var addressRegex = /^[a-zA-Z0-9-,]*$/;
    var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    var mobilePhoneNoRegex = /^[0-9]{10,12}$/;
    var homePhoneNoRegex = /^[0-9]{7,9}$/;

    if (!nameRegex.test(name)) {
        document.getElementById('nameError').textContent = 'Invalid name';
        event.preventDefault();
    }

    if (!matricNoRegex.test(matricNo)) {
        document.getElementById('matricNoError').textContent = 'Invalid matric number';
        event.preventDefault();
    }

    if (!addressRegex.test(currentAddress)) {
        document.getElementById('currentAddressError').textContent = 'Invalid current address';
        event.preventDefault();
    }

    if (!addressRegex.test(homeAddress)) {
        document.getElementById('homeAddressError').textContent = 'Invalid home address';
        event.preventDefault();
    }

    if (!emailRegex.test(email)) {
        document.getElementById('emailError').textContent = 'Invalid email';
        event.preventDefault();
    }

    if (!mobilePhoneNoRegex.test(mobilePhoneNo)) {
        document.getElementById('mobilePhoneNoError').textContent = 'Invalid mobile phone number';
        event.preventDefault();
    }

    if (!homePhoneNoRegex.test(homePhoneNo)) {
        document.getElementById('homePhoneNoError').textContent = 'Invalid home phone number';
        event.preventDefault();
    }
});