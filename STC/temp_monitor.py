class TemperatureMonitor:
    """Implements the Sliding Window algorithm for HVAC systems[cite: 140]."""
    
    def __init__(self, k=3):
        """Initializes the window with size k[cite: 148]."""
        self.k = k
        self.readings = []

    def add_reading(self, reading):
        """Adds a reading and removes the oldest if window is full [cite: 149-150]."""
        self.readings.append(reading)
        if len(self.readings) > self.k:
            self.readings.pop(0)

    def moving_average(self):
        """Calculates the average of the current window[cite: 151]."""
        if not self.readings:
            return 0
        return sum(self.readings) / len(self.readings)