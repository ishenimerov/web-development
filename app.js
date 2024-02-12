function fetchAndDisplayPosts() {
    // Get the element where you want to display the posts
    const postElement = document.getElementById('posts');

    // Fetch posts from the server using an endpoint like 'getPosts.php'
    fetch('api/getPosts.php')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            // Check if there are any posts
            if (data.length > 0) {
                // Iterate over each post and create a post card
                data.forEach(post => {
                    // Create a new div element to hold the post card
                    const postContainer = document.createElement('div');
                    postContainer.classList.add('post-card'); // Add a CSS class to the container

                    // Create an HTML template with placeholders for post data
                    const template = `
                        <div>
                            <h2>${post.post_title}</h2>
                        </div>
                        <div>
                            <p>${post.post_description}</p>
                        </div>
                    `;

                    // Set the inner HTML of the post container to the template with the actual post data
                    postContainer.innerHTML = template;

                    // Append the post container to the 'posts' element on the page
                    postElement.appendChild(postContainer);
                });
            } else {
                // Display a message if no posts are found
                postElement.innerHTML = 'No posts found';
            }
        })
        .catch(error => {
            // Handle any errors that occur during the fetch operation
            console.error('Error:', error);
        });
}

// Call the function when the page loads
window.addEventListener('load', fetchAndDisplayPosts);
