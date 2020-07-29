import multiprocessing

def task(i):
    pass

if __name__ == '__main__':
    processes = []

    for x in range(0, 100):
        p = multiprocessing.Process(target=task, args=(x))
        processes.append(p)
        p.start()

    for p in processes:
        p.join()