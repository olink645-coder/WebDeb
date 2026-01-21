from temp_monitor import TemperatureMonitor

def main():
    # Initialize monitor with window size k=3 [cite: 164]
    monitor = TemperatureMonitor(k=3)
    
    # Add test readings as specified in the project file [cite: 165-167]
    monitor.add_reading(24)
    monitor.add_reading(26)
    monitor.add_reading(29)
    
    # Output the result [cite: 168]
    print("Moving average:", monitor.moving_average())

if __name__ == "__main__":
    main()