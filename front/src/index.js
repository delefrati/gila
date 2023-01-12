import React from 'react';
import ReactDOM from 'react-dom/client';
import { BrowserRouter, Routes, Route } from "react-router-dom";
import "./index.css";
import App from './App';
import Form from './Components/Form/Form';
import Subscription from './Components/Subscription/Subscription';
import Logs from './Components/Logs/Logs';


export default function Application() {
  return (
   <BrowserRouter>
      <Routes>
      <Route path="/" element={<App />}>
          <Route path="form" index element={<Form />} />
          <Route path="subscription" element={<Subscription />} />
          <Route path="logs" element={<Logs />} />
        </Route>
      </Routes>
    </BrowserRouter>
  )
}
const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(<Application />);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
// reportWebVitals();
