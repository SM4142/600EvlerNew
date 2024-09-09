import axios from "axios"

function App() {
  
  const getData = async() =>{
    const data = await axios.post("http://localhost:80/api/login", {
      email: "mutaf861@gmail.com",
      password: "1232321",
    }, {
      withCredentials: true 
    });
    return data
  }
  console.log( getData())
  return (
    <>
     
    </>
  )
}

export default App
