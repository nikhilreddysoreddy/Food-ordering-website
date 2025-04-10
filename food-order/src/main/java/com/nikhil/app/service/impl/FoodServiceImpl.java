package com.nikhil.app.service.impl;

import com.nikhil.app.model.Food;
import com.nikhil.app.repository.FoodRepository;
import com.nikhil.app.service.FoodService;
import org.springframework.stereotype.Service;
import java.util.List;
import java.util.Optional;

@Service
public class FoodServiceImpl implements FoodService {

    private final FoodRepository foodRepository;

    public FoodServiceImpl(FoodRepository foodRepository) {
        this.foodRepository = foodRepository;
    }

    @Override
    public Food createFood(Food food) {
        return foodRepository.save(food);
    }

    @Override
    public List<Food> getAllFoods() {
        return foodRepository.findAll();
    }

    @Override
    public Food updateFood(Long id, Food updatedFood) {
        Optional<Food> existingFood = foodRepository.findById(id);
        if (existingFood.isPresent()) {
            Food food = existingFood.get();
            food.setName(updatedFood.getName());
            food.setPrice(updatedFood.getPrice());
            return foodRepository.save(food);
        }
        return null;
    }

    @Override
    public void deleteFood(Long id) {
        foodRepository.deleteById(id);
    }
}
