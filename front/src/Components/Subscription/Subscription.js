import React, { useEffect, useState } from "react";
import "./Subscription.css";
import api from '../../services/api'

function Subscription() {

  const [users, setUsers] = useState();
  const [channels, setChannels] = useState();
  const [categories, setCategories] = useState();

  useEffect(() => {
    api
      .get("/subscription")
      .then((response) => {
        setUsers(response.data.users);
        setChannels(response.data.channels);
        setCategories(response.data.categories);
      })
      .catch((err) => {
        console.error("Oops, got an error!" + err);
      });
  }, []);

  const getUsers = () => {
    if (users === undefined) {
      return '';
    }
    return users.map((option) => {
      return <option value={option.id}>{option.name}</option>
    })
  }
  const getChannels = () => {
    if (channels === undefined) {
      return '';
    }
    return channels.map((option) => {
      return <option value={option.type}>{option.type}</option>
    })
  }
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
    params.append('user', document.getElementById("user").value);
    params.append('category', document.getElementById("category").value);
    params.append('channel', document.getElementById("channel").value);
    api.post('/subscription', params)
      .then((response) => {alert(response.data.msg)})
      .catch((err) => {
        console.error("Oops! got an error " + err);
      });

  }

  return (
    <form onSubmit={handleSubmit} className='form'>
      <label>
          <select key="user" id="user">
            <optgroup label="User">
              {getUsers()}
            </optgroup>
          </select>
      </label>

      <label>
          <select key="category" id="category">
            <optgroup label="Category">
              {getCategories()}
            </optgroup>
          </select>
      </label>

      <label>
          <select key="channel" id="channel">
            <optgroup label="Channel">
              {getChannels()}
            </optgroup>
          </select>
      </label>

      <button id="bt_subscribe">Subscribe</button>
    </form>
  )
}

export default Subscription