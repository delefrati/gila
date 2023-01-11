import React from 'react'
import "./Form.css";

function Form() {
  return (
    <form className='form'>
      <label>
          <select>
            <option Disabled value="laranja">User</option>
          </select>
      </label>

      <label>
          <select>
            <option value="laranja">Category</option>
          </select>
      </label>

      <label>
          <select>
            <option value="laranja">Channel</option>
          </select>
      </label>
    </form>
  )
}

export default Form