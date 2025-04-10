package com.nikhil.app.service;

import com.nikhil.app.model.Food;
import java.util.List;

public interface FoodService {
    Food createFood(Food food);
    List<Food> getAllFoods();
    Food updateFood(Long id, Food food);
    void deleteFood(Long id);
}

