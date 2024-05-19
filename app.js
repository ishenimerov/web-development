function fetchAndDisplayPosts() {
    // Get the element where you want to display the posts
    const postElement = document.getElementById('posts');

    // Fetch posts from the server using an endpoint like 'getPosts.php'
    fetch('api/getPosts.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
        .then(data => {
            console.log(data);

            // Check if there are any posts
            if (data.length > 0) {
                // Iterate over each post and create a post card
                data.forEach(post => {
                    // Fetch user based on user_id
                    fetch(`api/getUser.php?user_id=${post.user_id}`)
                        .then(userResponse => userResponse.json())
                        .then(userData => {
                            const name = userData.name || 'Unknown';

                            // Create a new div element to hold the post card
                            const postContainer = document.createElement('div');
                            postContainer.classList.add('post-wrapper');

                            // Split post_description into paragraphs
                            const paragraphs = post.post_description.split('\n');

                            // Create an HTML template with placeholders for post data
                            const template = `
                                <img class="post-image" src="https://sxcontent9668.azureedge.us/cms-assets/assets/Haven1_Hero_5_2600x1400_a23f540f5f.jpg" alt="space-image" style="width: 100%; height: 100%;">

                                <div class='post-header'>
                                    <span class='post-date'>${formatDate(post.post_date)}</span>
                                    <span>${post.post_title}</span>
                                </div>
                                <div class='post-content'>
                                    ${paragraphs.map(paragraph => `<p>${paragraph}</p>`).join('')}
                                </div>
                                <span style="margin-bottom: 20px; font-weight: 500">${name}</span>
                                <hr style="color: black;">
                            `;

                            // Set the inner HTML of the post container to the template with the actual post data
                            postContainer.innerHTML = template;

                            // Append the post container to the 'posts' element on the page
                            postElement.appendChild(postContainer);
                        })
                        .catch(usernameError => {
                            console.error('Error fetching username:', usernameError);
                        });
                });
            } else {
                // Display a message if no posts are found
                postElement.innerHTML =`
                <div class='post-header'>
                     <span>No posts</span>
                    <hr style="color: black;">
                </div>`


            }
        })
        .catch(error => {
            // Handle any errors that occur during the fetch operation
            console.error('Error:', error);
        });
}

// Call the function when the page loads
window.addEventListener('load', fetchAndDisplayPosts);

function formatDate(dateString) {
    const inputDate = new Date(dateString);
    const formattedDate = inputDate.toLocaleDateString('en-US', {
        month: 'long',
        day: 'numeric',
        year: 'numeric',
    });
    return formattedDate.toUpperCase();
}
