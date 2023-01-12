import React, { useEffect, useState } from "react";
import "./Form.css";
import api from '../../services/api'

function Form() {

  const [categories, setCategories] = useState();

  useEffect(() => {
    api
      .get("/subscription")
      .then((response) => {
        setCategories(response.data.categories);
      })
      .catch((err) => {
        console.error("Oops, got an error!" + err);
      });
  }, []);

  const getCategories = () => {
    if (categories === undefined) {
      return '';
    }
    return categories.map((option) => {
      return <option value={option.id}>{option.name}</option>
    })
  }

  const handleSubmit = (event) => {
    event.preventDefault();

    const params = new URLSearchParams();
    params.append('category', document.getElementById("category").value);
    params.append('message', document.getElementById("message").value);
    api.post('/send', params)
      .then((response) => {alert(response.data.msg)})
      .catch((err) => {
        console.error("Oops! got an error " + err);
      });
  }

  return (
    <form onSubmit={handleSubmit} className='form'>

      <label>
          <select id="category">
            <optgroup label="Category">
              {getCategories()}
            </optgroup>
          </select>
      </label>
      <textarea id="message" placeholder="Message - you can use {name} and {channel}"></textarea>
      <button id="bt_send">Send Message!</button>
    </form>
  )
}

export default Form