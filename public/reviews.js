class Review{

    getAllReviewsOfUser(reviews){
        fetch(reviews,{ headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            method: "post"}).then(response => response.json())
            .then(reviewData => {
                let reviews = "";
                if(reviewData!='noResults'){
                    let errorElementRating = document.getElementById('errorRating');
                    if (reviewData == "error") {
                        errorElementRating.classList.add('msgSearch');
                        errorElementRating.style.display = "block";
                        errorElementRating.innerText = "Treba vypniť obidve polia";
                    }
                    else
                    {
                        document.getElementById("reviews-tab").classList.remove("msgSearch");
                        errorElementRating.style.display = "none";
                        for (let review of reviewData) {
                            fetch('?a=getWriter&review_id=' + review.id)
                                .then(response => response.json())
                                .then(writerData => {
                                    let writerName = writerData.name + " " + writerData.last_name
                                    fetch('?a=getOnlineUser')
                                        .then(response => response.json())
                                        .then(userData => {
                                            reviews +=" <div class=\"row\">" +
                                                "<div class=\"col-md-11\">" +
                                                "<p>" + review.rating + "</p>"+
                                                "<h6>" + review.text + "</h6>" +
                                                "</div>"
                                            if(userData.id===writerData.id)
                                            {
                                                reviews +="<div class=\"col-md-1\">" +
                                                    "<button id='"+review.id+"' onclick='deleteReview(this.id)' class=\"btn-review-edit transparent\"><i class=\"fas fa-trash-alt\"></i></button>" +
                                                    "</div>"
                                            }
                                            reviews +="</div> <div class=\"row\">" +
                                                "   <div class=\"col-md-12\">" +
                                                "    <p>"+writerName+"</p>" +
                                                "    </div>" +
                                                "    </div>"
                                            document.getElementById("reviews-tab").innerHTML = reviews;
                                        })
                                })
                        }
                    }

                }
                else
                {
                    reviews = "Užívateľ nemá žiadne recenzie";
                    document.getElementById("reviews-tab").classList.add('msgSearch');
                    document.getElementById("reviews-tab").innerHTML = reviews;
                }

            })
    }

    deleteReview(clicked_id){
        this.getAllReviewsOfUser('?a=deleteReview&review_id='+clicked_id);
    }

    addReview(){
        let receiver_id = document.getElementById('receiver_id').value;
        let writer_id = document.getElementById('writer_id').value;
        let text =  document.getElementById('text').value;
        let rating = document.getElementById('rating').value;

        document.getElementById('text').value=" ";
        document.getElementById('rating').value=" ";

        this.getAllReviewsOfUser('?a=addReview&receiver_id='+receiver_id+'&writer_id='+writer_id+'&text='+text+'&rating='+rating);
    }

}

window.onload = function () {

    let review= new Review();
    let input = document.getElementById('user_id').value;
    let reviewElement = document.getElementById('rev-tab');
    if(reviewElement)
    {
        reviewElement.onclick = () => {
            let reviews='?a=getAllReviewsOfUserProfile&user_id=' + input;
            review.getAllReviewsOfUser(reviews);
        }
        let addElement=document.getElementById('btn-review');
        addElement.onclick = () => {
            review.addReview();
        }
        let delElement=document.getElementsByName('review_name_del');
        delElement.onclick = () => {
            review.deleteReview();
        }
    }


}
function deleteReview(clicked_id){
    let review= new Review();
    review.deleteReview(clicked_id);
}
