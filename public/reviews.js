class Review{

    getAllReviewsOfUser(reviews){
        document.getElementById('reviewsBeforeAdd').style.display="none";
        fetch(reviews).then(response => response.json())
            .then(reviewData => {
                let reviews = "";
                if(reviewData!='noResults'){
                    let errorElementRating = document.getElementById('errorRating');
                    if (reviewData == "error") {
                        errorElementRating.classList.add("msgSearch");
                        errorElementRating.style.display = "block";
                        errorElementRating.innerText = "Treba vyplniť obidve polia";
                    }
                    else
                    {   errorElementRating.style.display = "none";
                        for (let review of reviewData) {
                            fetch('?a=getWriter&review_id=' + review.id)
                                .then(response => response.json())
                                .then(writerData => {
                                    let writerName = writerData.name + " " + writerData.last_name
                                    fetch('?a=getOnlineUser')
                                        .then(response => response.json())
                                        .then(userData => {
                                            reviews +=" <div class=\"row\" id='"+review.id+"'>" +
                                                            "<div class=\"col-md-11\">" +
                                                                "<p>" + review.rating + "</p>"+
                                                                "<h6>" + review.text + "</h6>" +
                                                            "</div>"
                                            if(userData.id===writerData.id)
                                            {
                                                reviews +="<div class=\"col-md-1\">" +
                                                                "<button  onclick='deleteReview("+review.id+")' class=\"btn-review-edit transparent\"><i class=\"fas fa-trash-alt\"></i></button>" +
                                                            "</div>"
                                            }
                                            reviews +=" <div class=\"row\">" +
                                                        "   <div class=\"col-md-12\">" +
                                                             "    <p>"+writerName+"</p>" +
                                                        "    </div>" +
                                                        "</div>" +
                                                    "</div>"
                                            document.getElementById("reviews-tab").innerHTML = reviews;
                                        })
                                })
                        }
                    }

                }

            })
    }



    addReview() {
        let receiver_id = document.getElementById('receiver_id').value;
        let writer_id = document.getElementById('writer_id').value;
        let text =  document.getElementById('text').value;
        let rating = document.getElementById('rating').value;

        document.getElementById('text').value="";
        document.getElementById('rating').value="";

        this.getAllReviewsOfUser('?a=addReview&receiver_id='+receiver_id+'&writer_id='+writer_id+'&text='+text+'&rating='+rating);
    }

}

window.onload = function () {

    let review= new Review();

    let addElement=document.getElementById('btn-review');
    if(addElement){
        addElement.onclick = () => {
            review.addReview();
        }
    }




}

function deleteReview(clicked_id){
    fetch('?a=deleteReview&review_id='+clicked_id);
    document.getElementById(clicked_id).remove();
}

