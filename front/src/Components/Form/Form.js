import React, { useEffect, useState } from "react";
import "./Form.css";
import api from '../../services/api'

function Form() {

  const [subscription, setSubscription] = useState();
  console.log(subscription);

  useEffect(() => {
    api
      .get("/subscription")
      .then((response) => setSubscription(response.data))
      .catch((err) => {
        console.error("Oop, got an error!" + err);
      });
  }, []);

  return (
    <form className='form'>
      <label>
          <select>
            <option>User</option>
          </select>
      </label>

      <label>
          <select>
            <option>Channel</option>
          </select>
      </label>

      <label>
          <select>
            <option>Category</option>
          </select>
      </label>

      <button type='button'>Subscribe</button>
    </form>
  )
}

export default Form