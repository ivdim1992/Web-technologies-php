import { useEffect, useState } from "react";

function Posts() {
  const [data, dataSet] = useState(null);
  const [title, setTitle] = useState("");
  const [body, setBody] = useState("");

  useEffect(() => {
    async function fetchMyAPI() {
      let response = await fetch("http://localhost:8000/api/posts", {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
      });
      response = await response.json();
      console.log("BLOGS", response);
      dataSet(response);
    }

    fetchMyAPI();
  }, []);

  const handleSubmit = async (event) => {
    event.preventDefault();

    const response = await fetch("http://localhost:8000/api/create-post", {
      method: "POST",
      body: JSON.stringify({
        title,
        body,
        user_id: 1,
      }),
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        laravel_session: "Cel0IMtdhb3INJre7Orqy1Vy537BWTzyCJNpddED",
      },
    });
    const posts = await response.json();
    console.log("POSTS", posts);
  };

  return (
    <div>
      <p>congrats you are logged in</p>
      {/* <form>
        <button>Log out</button>
      </form> */}

      <div>
        <h2>Create new form</h2>
        <form onSubmit={handleSubmit}>
          <input
            type="text"
            className="form-control mt-1"
            required
            value={title}
            onChange={(e) => {
              setTitle(e.target.value);
            }}
            placeholder="title"
          />
          <textarea
            type="text"
            className="form-control mt-1"
            required
            value={body}
            onChange={(e) => {
              setBody(e.target.value);
            }}
            placeholder="body content.."
          ></textarea>
          <button>Save Post</button>
        </form>
      </div>
    </div>
  );
}

export default Posts;
