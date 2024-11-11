import React, { useState } from "react";
import styled, { keyframes } from "styled-components";
import axios from "axios";
import utils from "../../utils";

// Styled components for styling the form
const FormContainer = styled.div`
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f8f9fa;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
`;

const Title = styled.h2`
  text-align: center;
  color: #333;
`;

const Label = styled.label`
  display: block;
  margin-bottom: 8px;
  color: #555;
  font-weight: bold;
`;

const Input = styled.input`
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
`;

const Button = styled.button`
  width: 100%;
  padding: 10px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;

  &:hover {
    background-color: #0056b3;
  }
`;

const Message = styled.p`
  text-align: center;
  color: ${(props) => (props.success ? "green" : "red")};
`;

// Spinner animation and styling
const rotate = keyframes`
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
`;

const Spinner = styled.div`
  border: 4px solid #f3f3f3;
  border-top: 4px solid #007bff;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  animation: ${rotate} 1s linear infinite;
  margin-left: 8px;
`;

function UpdateForm() {
  let { food, drink } = utils.getWindowData(
    'inject_react_user_data'
  );

  let startingFormData = {
    food: food,
    drink: drink,
  };
  const [formData, setFormData] = useState(startingFormData);
  const [message, setMessage] = useState("");
  const [isSuccess, setIsSuccess] = useState(false);
  const [loading, setLoading] = useState(false); // New loading state

  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true); // Start loading spinner

    try {
      const response = await utils.fetchWP(
        formData,
        "update_favorite_food_and_drink"
      );
      if (response.result !== "success") {
        throw new Error(response.message);
      }
      setMessage("Form submitted successfully!");
      setIsSuccess(true);
    } catch (error) {
      setMessage("There was an error submitting the form.");
      setIsSuccess(false);
    } finally {
      setLoading(false); // Stop loading spinner
    }
  };

  return (
    <FormContainer>
      <Title>Submit Form</Title>
      <form onSubmit={handleSubmit}>
        <Label htmlFor="drink">Favorite Drink</Label>
        <Input
          type="text"
          id="drink"
          name="drink"
          value={formData.drink}
          onChange={handleChange}
          required
        />
        <Label htmlFor="food">Favorite Food</Label>
        <Input
          type="text"
          id="food"
          name="food"
          value={formData.food}
          onChange={handleChange}
          required
        />
        <Button type="submit">
          Submit
          {loading && <Spinner />} {/* Show spinner when loading */}
        </Button>
      </form>
      {message && <Message success={isSuccess}>{message}</Message>}
    </FormContainer>
  );
}

export default UpdateForm;
