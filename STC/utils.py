def validate_reading(val):
    """Ensures input is a valid number[cite: 2]."""
    try:
        return float(val)
    except (ValueError, TypeError):
        raise ValueError("Invalid temperature. Please enter a number.")