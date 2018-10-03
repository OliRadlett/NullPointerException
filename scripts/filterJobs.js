let tagInputBox = document.getElementById("tag-input");
let addTagButton = document.getElementById("addTagButton");
let tagsDiv = document.getElementById("tagsDiv");
let tagsArray;
let currentTags = [];

window.onload = getTags;

function addTagToFilter() {

    let tag = tagInputBox.value;

    if (tag !== null && tag !== "") {

        currentTags.push(tag);

        console.log("Adding " + tag + " to filter");
        console.log("Filters are now: " + currentTags);

        let newTag = document.createElement("p");
        let newTagNode = document.createTextNode(tag);
        newTag.appendChild(newTagNode);
        newTag.setAttribute("class", "tags");
        newTag.setAttribute("id", tag);
        newTag.setAttribute("onclick", "removeTag('" + tag + "')");
        tagsDiv.appendChild(newTag);

        downloadJobs();

        tagInputBox.value = "";
        addTagButton.setAttribute("hidden", "true");

    }

}

function showAddTagButton() {

    let tag = tagInputBox.value;

    if (tag !== null && tag !== "") {

        addTagButton.removeAttribute("hidden");

    } else {

        addTagButton.setAttribute("hidden", "true");

    }

}

function getTags() {

    let httpRequest = new XMLHttpRequest();
    let url = "/downloadTags.php";

    if (!httpRequest) {

        console.log("Error: could not create XMLHttpRequest object");
        return false;

    }

    httpRequest.onreadystatechange = function () {

        if (httpRequest.readyState === XMLHttpRequest.DONE) {

            if (httpRequest.status === 200) {

                let request = httpRequest.response;
                tagsArray = request.split("<br/>");
                console.log(tagsArray);
                autocomplete(tagInputBox, tagsArray);

            }

        }

    };

    httpRequest.open("GET", url);
    httpRequest.send();

}

function removeTag(tag) {

    document.getElementById(tag).remove();
    let index = currentTags.indexOf(tag)
    currentTags.splice(index, 1);
    downloadJobs();

}

function downloadJobs() {

    let tagsStr = "";
    let httpRequest = new XMLHttpRequest();
    let url = "";

    for (let i = 0; i < currentTags.length; i++) {

        tagsStr += currentTags[i];

        if (i !== currentTags.length - 1) {

            tagsStr += ",";

        }

    }

    console.log("Tags String: " + tagsStr);

    url = "downloadJobs.php?tags=" + tagsStr;

    console.log("GET URL: " + url);

}