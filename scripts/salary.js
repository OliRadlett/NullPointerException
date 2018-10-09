document.getElementById("salaryInput").addEventListener("keypress", function (e) {

    let allowedChars = '0123456789';

    function contains(stringValue, charValue) {

        return stringValue.indexOf(charValue) > -1;

    }

    let invalidKey = e.key.length === 1 && !contains(allowedChars, e.key) || e.key === '.' && contains(e.target.value, '.');
    invalidKey && e.preventDefault();

});